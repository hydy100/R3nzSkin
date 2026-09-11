<?php

namespace SolveCaptcha\Tests;

class FunCaptchaTest extends AbstractWrapperTestCase
{
    protected $method = 'funcaptcha';

    public function testAllOptions()
    {
        $params = [
            'sitekey'   => '69A21A01-CC7B-B9C6-0F9A-E7FA06677FFC',
            'url'       => 'https://mysite.com/page/with/funcaptcha',
            'surl'      => 'https://client-api.arkoselabs.com',
            'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36',
            'data'      =>  '{"anyKey":"anyStringValue"}',
            'proxy'     => [
                'type' => 'HTTPS',
                'uri'  => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            ]
        ];

        $sendParams = [
            'method'    => 'funcaptcha',
            'publickey' => '69A21A01-CC7B-B9C6-0F9A-E7FA06677FFC',
            'pageurl'   => 'https://mysite.com/page/with/funcaptcha',
            'surl'      => 'https://client-api.arkoselabs.com',
            'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36',
            'data'      =>  '{"anyKey":"anyStringValue"}',
            'proxy'     => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            'proxytype' => 'HTTPS',
            'soft_id'   => '4585',
            'json'       => '0'
        ];

        $this->checkIfCorrectParamsSendAndResultReturned([
            'params'     => $params,
            'sendParams' => $sendParams,
            'sendFiles'  => [],
        ]);
    }
}
