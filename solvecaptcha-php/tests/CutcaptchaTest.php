<?php

namespace SolveCaptcha\Tests;

class CutcaptchaTest extends AbstractWrapperTestCase
{
    protected $method = 'cutcaptcha';

    public function testAllOptions()
    {
        $params = [
            'misery_key' => 'a1488b66da00bf332a1488993a5443c79047e752',
            'api_key'    => 'SAb83IIB',
            'url'        => 'https://example.cc/foo/bar.html',
            'proxy'      => [
                'type' => 'HTTPS',
                'uri'  => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            ]
        ];

        $sendParams = [
            'method'     => 'cutcaptcha',
            'misery_key' => 'a1488b66da00bf332a1488993a5443c79047e752',
            'api_key'    => 'SAb83IIB',
            'pageurl'    => 'https://example.cc/foo/bar.html',
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
