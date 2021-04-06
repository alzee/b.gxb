<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;
use Darabonba\OpenApi\Models\Config;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;
use GuzzleHttp\Exception\RequestException;
use WechatPay\GuzzleMiddleware\WechatPayMiddleware;
use WechatPay\GuzzleMiddleware\Util\PemUtil;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;

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

    function __construct(HttpClientInterface $client)
    {
        $this->httpclient = $client;
        $this->mchid = $_ENV['mchid'];
        $this->appid = $_ENV['appid'];
        $this->appsecret = $_ENV['appsecret'];
        $this->api_cert_sn = $_ENV['api_cert_sn'];
        $this->apikey = $_ENV['apikey'];
        $this->apikey_v3 = $_ENV['apikey_v3'];
        $this->mch_private_key_file = $_ENV['mch_private_key_file'];
    }

    /**
     * @Route("/genSig", name="_gensig")
     */
    function genSig($url = "https://api.mch.weixin.qq.com/v3/certificates", $http_method = "GET", $body = "")
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
        // $mch_private_key  = openssl_get_privatekey(file_get_contents($this->mch_private_key_file));
        return $mch_private_key;
    }

    public static function getCertificate($filepath) {
        return openssl_x509_read(file_get_contents($filepath));
    }

    /**
     * @Route("/cert", name="_cert")
     */
    public function getCertificates()
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
        dump($content);
        // return $this->json($resp);
    }

    /**
     * @Route("/prepayid", name="_prepayid")
     */
    function generatePrepayId()
    {
        $url = "https://api.mch.weixin.qq.com/v3/pay/transactions/app";
        $method = 'POST';
        $data = [
            'appid' => $this->appid,
            'mchid' => $this->mchid,
            'description' => 'desc',
            'out_trade_no' => 'd12345678',
            'notify_url' => 'http://backend.drgxb.com',
            'amount' => [
                'total' => 1
            ]
        ];

        $sig = $this->genSig($url, $method, json_encode($data));
        $header[] = 'Content-Type: application/json';
        $header[] = 'Accept:application/json';
        $header[] = $sig;
        $resp = $this->httpclient->request($method, $url ,['headers' => $header, 'json' => $data]);
        $content = json_decode($resp->getContent(), true);

        $mchid = $this->mchid;
        $appid = $this->appid;
        $timestamp = time();
        $nonce = md5(uniqid());
        $prepayid = $content['prepay_id'];
        $msg = $appid . "\n".
            "$timestamp" . "\n" .
            "$nonce" . "\n" .
            $prepayid . "\n";

        dump($msg);
        openssl_sign($msg, $raw_sign, $this->getMchPrivatekey(), 'sha256WithRSAEncryption');
        $sig1 = base64_encode($raw_sign);

        $d = [
            'appid' => $appid,
            'partnerid' => $mchid,
            'prepayid' => $prepayid,
            //'package' => 'Sign=WXPay',
            'noncestr' => $nonce,
            'timestamp' => "$timestamp",
            'sign' => $sig1
        ];

        // return $this->json($d);
    }

    /**
     * @Route("/wxpay", name="_wxpay")
     */
    public function wxpay(): Response
    {
        // 商户相关配置，
        $merchantId = $this->mchid; // 商户号
        $merchantSerialNumber = $this->api_cert_sn; // 商户API证书序列号
        $merchantPrivateKey = PemUtil::loadPrivateKey('/home/al/cert/wxpay/apiclient_key.pem'); // 商户私钥文件路径

        // 微信支付平台配置
        $wechatpayCertificate = PemUtil::loadCertificate('/home/al/cert/wxpay/wechatpay_5772C642163189E65783E430BDBDD78AB52A840D.pem'); // 微信支付平台证书文件路径

        // 构造一个WechatPayMiddleware
        $wechatpayMiddleware = WechatPayMiddleware::builder()
            ->withMerchant($merchantId, $merchantSerialNumber, $merchantPrivateKey) // 传入商户相关配置
            ->withWechatPay([ $wechatpayCertificate ]) // 可传入多个微信支付平台证书，参数类型为array
            ->build();

        // 将WechatPayMiddleware添加到Guzzle的HandlerStack中
        $stack = HandlerStack::create();
        $stack->push($wechatpayMiddleware, 'wechatpay');

        // 创建Guzzle HTTP Client时，将HandlerStack传入，接下来，正常使用Guzzle发起API请求，WechatPayMiddleware会自动地处理签名和验签
        $client = new Client(['handler' => $stack]);

        // 接下来，正常使用Guzzle发起API请求，WechatPayMiddleware会自动地处理签名和验签
        try {
            // $resp = $client->request('GET', 'https://api.mch.weixin.qq.com/v3/certificates', [ // 注意替换为实际URL
            //     'headers' => [ 'Accept' => 'application/json' ]
            // ]);

            // echo $resp->getStatusCode().' '.$resp->getReasonPhrase()."\n";
            // echo $resp->getBody()."\n";

            $resp = $client->request('POST', 'https://api.mch.weixin.qq.com/v3/pay/transactions/app', [
                'json' => [ // JSON请求体
                    'appid' => $this->appid,
                    'mchid' => $this->mchid,
                    'description' => 'desc',
                    'out_trade_no' => 'd12345678',
                    'notify_url' => 'http://backend.drgxb.com',
                    'amount' => [
                        'total' => 1
                    ]
                ],
                'headers' => [ 'Accept' => 'application/json' ]
            ]);

            echo $resp->getStatusCode().' '.$resp->getReasonPhrase()."\n";
            echo $resp->getBody()."\n";
        } catch (RequestException $e) {
            // 进行错误处理
            echo $e->getMessage()."\n";
            if ($e->hasResponse()) {
                echo $e->getResponse()->getStatusCode().' '.$e->getResponse()->getReasonPhrase()."\n";
                echo $e->getResponse()->getBody();
            }
            dump($e->getResponse()->getBody());
            return 1;
        }
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
            'code' => $code,
            'phone' => $phone,
            'type' => $type,
            'msg' => $msg
            //'keyId' => $accessKeyId,
            //'keySec' => $accessKeySecret,
        ]);
    }
}
