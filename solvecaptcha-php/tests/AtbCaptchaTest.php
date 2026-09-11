<?php

namespace SolveCaptcha\Tests;

class AtbCaptchaTest extends AbstractWrapperTestCase
{
    protected $method = 'atb_captcha';

    public function testAllOptions()
    {
        $params = [
            'sitekey'    => 'af23e041b22d000a11e22a230fa8991c',
            'api_server' => 'https://cap.aisecurius.com',
            'url'        => 'https://example.com/',
            'proxy'      => [
                'type' => 'HTTPS',
                'uri'  => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            ]
        ];

        $sendParams = [
            'method'     => 'atb_captcha',
            'app_id'     => 'af23e041b22d000a11e22a230fa8991c',
            'api_server' => 'https://cap.aisecurius.com',
            'pageurl'    => 'https://example.com/',
            'proxy'      => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            'proxytype'  => 'HTTPS',
            'soft_id'    => '4585',
            'json'       => '0'
        ];

        $this->checkIfCorrectParamsSendAndResultReturned([
            'params'     => $params,
            'sendParams' => $sendParams,
            'sendFiles'  => [],
        ]);
    }
}
