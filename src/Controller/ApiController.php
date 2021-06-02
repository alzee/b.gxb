<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\CurlHttpClient;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;
use Darabonba\OpenApi\Models\Config;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;
use App\Entity\Finance;
use App\Entity\User;
use App\Entity\Bid;
use App\Entity\EquityTrade;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * @Route("/api", name="api")
 */
class ApiController extends AbstractController
{
    private $httpclient;
    private $mchid;
    private $appid;
    private $appsecret;
    private $api_cert_sn;
    private $apikey;
    private $apikey_v3;
    private $mch_private_key_file;
    private $mch_cert_file;

    public function __construct(HttpClientInterface $client)
    {
        $this->httpclient = $client;
        $this->mchid = $_ENV['mchid'];
        $this->appid = $_ENV['appid'];
        $this->appsecret = $_ENV['appsecret'];
        $this->api_cert_sn = $_ENV['api_cert_sn'];
        $this->apikey = $_ENV['apikey'];
        $this->apikey_v3 = $_ENV['apikey_v3'];
        $this->mch_private_key_file = $_ENV['mch_private_key_file'];
        $this->mch_cert_file = $_ENV['mch_cert_file'];
    }

    /**
     * @Route("/paid", name="_paid")
     */
    public function paid(Request $request, LoggerInterface $logger): Response
    {
        // get order info from wx callback

        $wxsig = $request->headers->get('Wechatpay-Signature');
        // verify Wechatpay-Signature

        $params  = $request->toArray();
        $id = $params['id'];
        $time = $params['create_time'];
        $resType = $params['resource_type'];
        $evType = $params['event_type'];
        $resource = $params['resource'];
        $summary = $params['summary'];
        $algorithm = $resource['algorithm'];
        $ciphertext = $resource['ciphertext'];
        $nonce = $resource['nonce'];
        $associated_data = $resource['associated_data'];
        $json = sodium_crypto_aead_aes256gcm_decrypt(base64_decode($ciphertext), $associated_data, $nonce, $this->apikey_v3);
        $data = json_decode($json, true);
        $wxorderid = $data['transaction_id'];
        $orderid = $data['out_trade_no'];
        $trade_state = $data['trade_state'];
        // $success_time = $data['success_time'];
        // $payer = $data['payer'];
        // $amount = $data['amount'];

        // $logger->info('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
        // $logger->info($wxsig);
        // $logger->info($id);
        // $logger->info($time);
        // $logger->info($resType);
        // $logger->info($evType);
        // $logger->info($summary);
        // $logger->info($algorithm);
        // $logger->info($ciphertext);
        // $logger->info($nonce);
        // $logger->info($associated_data);
        // $logger->info($json);
        // $logger->info($wxorderid);
        // $logger->info($orderid);
        // $logger->info($trade_state);
        // $logger->info('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
        
        $em = $this->getDoctrine()->getManager();
        $order = $this->getDoctrine()->getRepository(Finance::class)->findOneBy(['orderid' => $orderid]);
        $order->setWxpayData($data);
        $order->setWxOrderid($wxorderid);
        // update order status
        if ($trade_state == 'SUCCESS') {
            $order->setStatus(5);
        }
        $em->flush();

        $msg = [
            "code" => "SUCCESS",
            "message" => "成功"
        ];
        return $this->json($msg);
    }

    /**
     * @Route("/genSig", name="_gensig")
     */
    public function genSig($url = "https://api.mch.weixin.qq.com/v3/certificates", $http_method = "GET", $body = "")
    {
        $url_parts = parse_url($url);
        $canonical_url = ($url_parts['path'] . (!empty($url_parts['query']) ? "?${url_parts['query']}" : ""));
        $timestamp = time();
        $nonce = md5(uniqid());
        // $nonce = '593BEC0C930BF1AFEB40B4A08C8FB242';
        $merchant_id = $this->mchid;
        $serial_no = $this->api_cert_sn;
        $mch_private_key = $this->getMchPrivatekey();
        $message = $http_method."\n".
            $canonical_url."\n".
            $timestamp."\n".
            $nonce."\n".
            $body."\n";

        openssl_sign($message, $raw_sign, $mch_private_key, 'sha256WithRSAEncryption');
        $sign = base64_encode($raw_sign);

        $schema = 'Authorization: WECHATPAY2-SHA256-RSA2048';
        $token = $schema . ' ' . sprintf('mchid="%s",nonce_str="%s",timestamp="%d",serial_no="%s",signature="%s"',
            $merchant_id, $nonce, $timestamp, $serial_no, $sign);

        return $token;
        // return $this->json($token);
    }


    public function getMchPrivatekey()
    {
        $mch_private_key  = openssl_get_privatekey($this->mch_private_key_file);
        return $mch_private_key;
    }

    public function getWXCert($filepath) {
        return openssl_x509_read(file_get_contents($filepath));
    }

    /**
     * @Route("/cert", name="_cert")
     */
    public function getWXCertList()
    {
        $url = "https://api.mch.weixin.qq.com/v3/certificates";
        $method = 'GET';
        $merchant_id =$this->mchid;
        $serial_no = $this->api_cert_sn;
        $sig = $this->genSig($url, $method, "");
        // $header[] = 'User-Agent:https://zh.wikipedia.org/wiki/User_agent';
        $header[] = 'Content-Type: application/json';
        $header[] = 'Accept:application/json';
        $header[] = $sig;
        $resp = $this->httpclient->request($method, $url ,['headers' => $header]);
        $content = $resp->getContent(false);
        // return $this->json($resp);
    }

    /**
     * @Route("/order", name="_order")
     */
    function order(Request $request): Response
    {
        $params  = $request->toArray();
        $amount = $params['amount'];
        $uid = $params['uid'];
        $type = $params['type'];
        $method = $params['method'];
        $note = $params['note'];
        $couponId = isset($params['couponId']) ? $params['couponId'] : 0;
        $fee = isset($params['fee']) ? $params['fee'] : 0;
        $data = isset($params['data']) ? $params['data'] : [];
        $orderid = uniqid() . time();

        // create new order
        $em = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(User::class)->find($uid);
        $order = new Finance();
        $order->setNote($note);
        $order->setType($type);
        $order->setOrderid($orderid);
        $order->setUser($user);
        $order->setAmount($amount);
        $order->setMethod($method);
        $order->setCouponId($couponId);
        $order->setFee($fee);
        $order->setData($data);

        if ($method == 0) {     // use balance
            $d = [
                'code' => 0,
                'msg' => 'success'
            ];
        }

        if ($method == 1) {    // 微信支付统一下单
            $url = "https://api.mch.weixin.qq.com/v3/pay/transactions/app";
            $httpMethod = 'POST';
            $data0 = [
                'appid' => $this->appid,
                'mchid' => $this->mchid,
                'description' => '达人共享宝-在线支付',
                'out_trade_no' => $orderid,
                'notify_url' => 'https://backend.drgxb.com/api/paid',
                'amount' => [
                    // 'total' => 1 // pay 0.01 in testing
                    'total' => $amount
                ]
            ];

            $sig = $this->genSig($url, $httpMethod, json_encode($data0));
            $header[] = 'Content-Type: application/json';
            $header[] = 'Accept:application/json';
            $header[] = $sig;
            $resp = $this->httpclient->request($httpMethod, $url ,['headers' => $header, 'json' => $data0]);
            $content = $resp->toArray();
            $prepayid = $content['prepay_id'];

            $order->setPrepayid($prepayid);
            
            // params app needed for invoke payment. It's more convenient to get them on server.
            $mchid = $this->mchid;
            $appid = $this->appid;
            $timestamp = time();
            $nonce = md5(uniqid());
            $msg = $appid . "\n".
                $timestamp . "\n" .
                $nonce . "\n" .
                $prepayid . "\n";

            openssl_sign($msg, $raw_sign, $this->getMchPrivatekey(), 'sha256WithRSAEncryption');
            $sig1 = base64_encode($raw_sign);

            $d = [
                'appid' => $appid,
                'partnerid' => $mchid,
                'prepayid' => $prepayid,
                //'package' => 'Sign=WXPay',
                'noncestr' => $nonce,
                'timestamp' => $timestamp,
                'sign' => $sig1
            ];
        }

        if ($type == 19) {  // withdraw
            $check_name = 'NO_CHECK';
            $desc = '提现';
            $mch_appid = $this->appid;
            $mchid = $this->mchid;
            $nonce_str = md5(uniqid());
            $openid = $params['openid'];
            $partner_trade_no = $orderid;
            $key = $this->apikey;

            $string = "amount=${amount}&check_name=${check_name}&desc=${desc}&mch_appid=${mch_appid}&mchid=${mchid}&nonce_str=${nonce_str}&openid=${openid}&partner_trade_no=${partner_trade_no}&key=${key}";
            $sign = strtoupper(md5($string));

            $data = <<<EOT
<xml>
<amount>${amount}</amount>
<check_name>${check_name}</check_name>
<desc>${desc}</desc>
<mch_appid>${mch_appid}</mch_appid>
<mchid>${mchid}</mchid>
<nonce_str>${nonce_str}</nonce_str>
<openid>${openid}</openid>
<partner_trade_no>${partner_trade_no}</partner_trade_no>
<sign>${sign}</sign>
</xml>
EOT;
            $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
            $header[] = 'Content-Type: text/xml';
            
            $client = new CurlHttpClient();
            // $resp = $client->request('POST', $url ,['headers' => $header, 'body' => $data, 'extra' => ['curl' => [CURLOPT_SSLCERT => $mch_cert_file]]]);
            $resp = $client->request('POST', $url ,['headers' => $header, 'body' => $data, 'local_cert' => $mch_cert_file ]);
            $d = $resp->getContent();
        }

        $em->persist($order);
        $em->flush();

        if ($method == 0) {
            $order->setStatus(5);
            $em->flush();
        }

        return $this->json($d);
    }

    /**
     * @Route("/sms", name="_sms")
     */
    public function sms(): Response
    {
        $request = Request::createFromGlobals();
        $phone = $request->get('phone');
        $type = $request->get('type');
        $pass = $request->get('pass');
        $accessKeyId = $_ENV['accessKeyId'];
        $accessKeySecret = $_ENV['accessKeySecret'];
        $signName = '达人共享宝';
        $code = mt_rand(100000, 999999);
        switch($type){
            case 'verify':
                $templateCode = 'SMS_211140349';
                break;
            case 'login':
                $templateCode = 'SMS_211140348';
                break;
            case 'alert':
                $templateCode = 'SMS_211140347';
                break;
            case 'regsiter':
                $templateCode = 'SMS_211140346';
                break;
            case 'passwd':
                $templateCode = 'SMS_211140345';
                break;
            case 'usermod':
                $templateCode = 'SMS_211140344';
                break;
            default:
                $templateCode = 'SMS_211140348';
        }

        $config = new Config([
            "accessKeyId" => $accessKeyId,
            "accessKeySecret" => $accessKeySecret 
        ]);
        //$config->endpoint = "dysmsapi.aliyuncs.com";
        $client = new Dysmsapi($config);

        $sendSmsRequest = new SendSmsRequest([
            "phoneNumbers" => $phone,
            "signName" => $signName,
            "templateCode" => $templateCode,
            "templateParam" => "{\"code\":\"$code\"}"
        ]);
        if($pass == $_ENV['pass']){
            $client->sendSms($sendSmsRequest);
            $msg = 'Sent';
        }
        elseif($pass == 'test'){
            $msg = 'test Sent';
        }
        else{
            $msg = 'Wrong password';
        }

        return $this->json([
            'code' => "$code",
            'phone' => $phone,
            'type' => $type,
            'msg' => $msg
            //'keyId' => $accessKeyId,
            //'keySec' => $accessKeySecret,
        ]);
    }

    /**
     * @Route("/ranking", name="_ranking")
     */
    public function ranking(Request $request): Response
    {
        /*
        $conn = $this->getDoctrine()->getManager()->getConnection();

        $sql = '
            SELECT referrer_id, count(referrer_id) as count FROM user u
            where referrer_id is not null
            group by u.referrer_id
            ORDER BY count desc
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        $r = $stmt->fetchAllAssociative();
         */

        $userRepo = $this->getDoctrine()->getRepository(User::class);
        $ranking = $userRepo->ranking();

        return $this->json($ranking);
    }

    /**
     * @Route("/equity_trades/total", name="_total_equity_trades")
     */
    public function totalEquityTrades(Request $request): Response
    {
        $trades = $this->getDoctrine()->getRepository(EquityTrade::class)->findBy(['status' => 1]);
        $total = 0;
        foreach ($trades as $t) {
            $total += $t->getRmb();
        }
        return $this->json($total);
    }

    /**
     * @Route("/refcount/{uid}", name="refer_count")
     */
    public function refcount(int $uid): Response
    {
        $userRepo = $this->getDoctrine()->getRepository(User::class);
        $user = $userRepo->find($uid);
        $count1 = $userRepo->count(['referrer' => $user]);
        $count2 = $userRepo->count(['ror' => $user]);
        $resp = [
            $count1,
            $count2
        ];
        return $this->json($resp);
    }

    /**
     * @Route("/getbids", name="get_bids")
     */
    public function getBids(): Response
    {
        $bidRepo = $this->getDoctrine()->getRepository(Bid::class);

        for ($i = 0; $i < 4; $i++) {
            $bids[$i] = $bidRepo->getBids($i);
        }

        return $this->json($bids);
    }

    /**
     * @Route("/wxauth", name="wxauth")
     */
    public function wxauth(Request $request): Response
    {
        $params  = $request->toArray();
        $code = $params['code'];
        $uid = $params['uid'];
        $user = $this->getDoctrine()->getRepository(User::class)->find($uid);
        $appid = $this->appid;
        $secret = $this->appsecret;
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=${appid}&secret=${secret}&code=${code}&grant_type=authorization_code";
        $header[] = 'Content-Type: application/json';
        $header[] = 'Accept:application/json';
        $resp = $this->httpclient->request('GET', $url ,['headers' => $header]);
        $content = $resp->toArray();
        $token = $content["access_token"];
        $refresh_token = $content["access_token"];
        $openid = $content['openid'];
        $unionid = $content['unionid'];

        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=${token}&openid=${openid}";
        $resp = $this->httpclient->request('GET', $url ,['headers' => $header]);
        $content = $resp->toArray();
        $em = $this->getDoctrine()->getManager();
        $path = '/media/avatar/' . $user->getId() . '.jpg';
        file_put_contents('.' . $path, file_get_contents($content['headimgurl']));
        $user->setAvatar($path);
        $em->flush();

        return $this->json($content);
    }

    /**
     * @Route("/chkpass", name="chkpass")
     */
    public function chkpass(Request $request, EncoderFactoryInterface $factory): Response
    {
        $params = $request->toArray();
        $type = $params['type'];
        $pass = $params['pass'];
        $uid = $params['uid'];
        $user = $this->getDoctrine()->getRepository(User::class)->find($uid);
        $encoder = $factory->getEncoder(new User());
        
        switch ($type) {
        case 0:
            $pass0 = $user->getPassword();
            break;
        case 1:
            $pass0 = $user->getPayPasswd();
            break;
        }

        if ($encoder->isPasswordValid($pass0, $pass, null)) {
            $code = 0;
        }
        else {
            $code = 1;
        }

        return $this->json(['code' => $code]);
    }

    /**
     * @Route("/paypassnull/{uid}", name="paypass_null")
     */
    public function paypassNull($uid): Response
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($uid);
        if ($user->getPayPasswd() == null) {
            $code = 0;
        }
        else {
            $code = 1;
        }
        
        return $this->json(['code' => $code]);
    }

    /**
     * @Route("/chkcred", name="chkcred")
     */
    public function chkcred(Request $request): Response
    {
        $params = $request->toArray();
        $cred = $params['cred'];
        $userRepo = $this->getDoctrine()->getRepository(User::class);
        $user = $userRepo->findOneBy(['username' => $cred]);
        if (is_null($user)) {
            $user = $userRepo->findOneBy(['phone' => $cred]);
        }

        if (is_null($user)) {
            $code = 1;
            $uid = 0;
            $phone = 0;
        }
        else {
            $code = 0;
            $uid = $user->getId();
            $phone = $user->getPhone();
        }

        return $this->json(['code' => $code, 'uid' => $uid, 'phone' => $phone]);
    }

    /**
     * @Route("/landprofit/{uid}", name="landprofit")
     */
    public function landprofit($uid): Response
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($uid);
        $financeRepo = $this->getDoctrine()->getRepository(Finance::class);

        $landProfit = $financeRepo->sumTypeByUser(55, $user);
        $cellProfit = $financeRepo->sumTypeByUser(57, $user);

        if (is_null($landProfit)) {
            $landProfit = 0;
        }
        if (is_null($cellProfit)) {
            $cellProfit = 0;
        }

        return $this->json(['landProfit' => $landProfit, 'cellProfit' => $cellProfit]);
    }
}
