<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;
use Darabonba\OpenApi\Models\Config;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;

/**
 * @Route("/api", name="api")
 */
class ApiController extends AbstractController
{
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
