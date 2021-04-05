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
    private $mch_private_key;

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
     * @Route("/auth", name="_auth")
     */
    function auth($url = "https://api.mch.weixin.qq.com/v3/certificates", $http_method = "GET", $body = "")
    {
        $url_parts = parse_url($url);
        $canonical_url = ($url_parts['path'] . (!empty($url_parts['query']) ? "?${url_parts['query']}" : ""));
        dump($canonical_url);
        $timestamp = time();
        $nonce = md5(uniqid());
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
        //$mch_private_key  = openssl_get_privatekey(file_get_contents($this->mch_private_key_file));
        return $mch_private_key;
    }

    /**
     * @Route("/cert", name="_cert")
     */
    public function getCertificates()
    {
        $url = "https://api.mch.weixin.qq.com/v3/certificates";
        $merchant_id =$this->mchid;
        $serial_no = $this->api_cert_sn;
        $auth = $this->auth($url, "GET", "");
        $header[] = 'User-Agent:https://zh.wikipedia.org/wiki/User_agent';
        $header[] = 'Accept:application/json';
        $header[] = $auth;
        $resp = $this->httpclient->request('GET', $url ,['headers' => $header]);
        $content = $resp->getContent();
        return $this->json($resp);
    }

    /**
     * @Route("/prepayid", name="_prepayid")
     */
    function generatePrepayId($app_id, $mch_id)
    {
        $params = array(
            'appid'            => $app_id,
            'mch_id'           => $mch_id,
            'nonce_str'        => generateNonce(),
            'body'             => 'Test product name',
            'out_trade_no'     => time(),
            'total_fee'        => 1,
            'spbill_create_ip' => '8.8.8.8',
            'notify_url'       => 'http://localhost',
            'trade_type'       => 'APP',
        );

        // add sign
        $params['sign'] = calculateSign($params, APP_KEY);

        // create xml
        $xml = getXMLFromArray($params);

        // send request
        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL            => "https://api.mch.weixin.qq.com/pay/unifiedorder",
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => array('Content-Type: text/xml'),
            CURLOPT_POSTFIELDS     => $xml,
        ));

        $result = curl_exec($ch);
        curl_close($ch);

        // get the prepay id from response
        $xml = simplexml_load_string($result);
        return (string)$xml->prepay_id;
    }

    /**
     * @Route("/wxpay", name="_wxpay")
     */
    public function wxpay(): Response
    {
        // 商户相关配置，
        $merchantId = '1606036532'; // 商户号
        $merchantSerialNumber = '58ECB0644D50C6454BE2BDA53BA2422CA20B45A2'; // 商户API证书序列号
        $merchantPrivateKey = PemUtil::loadPrivateKey('/home/al/cert/wxpay/apiclient_key.pem'); // 商户私钥文件路径

        // 微信支付平台配置
        $wechatpayCertificate = PemUtil::loadCertificate('/home/al/cert/wxpay/apiclient_cert.pem'); // 微信支付平台证书文件路径

        // 构造一个WechatPayMiddleware
        $wechatpayMiddleware = WechatPayMiddleware::builder()
            ->withMerchant($merchantId, $merchantSerialNumber, $merchantPrivateKey) // 传入商户相关配置
            ->withWechatPay([ $wechatpayCertificate ]) // 可传入多个微信支付平台证书，参数类型为array
            ->build();

        // 将WechatPayMiddleware添加到Guzzle的HandlerStack中
        $stack = GuzzleHttp\HandlerStack::create();
        $stack->push($wechatpayMiddleware, 'wechatpay');

        // 创建Guzzle HTTP Client时，将HandlerStack传入，接下来，正常使用Guzzle发起API请求，WechatPayMiddleware会自动地处理签名和验签
        $client = new GuzzleHttp\Client(['handler' => $stack]);
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
