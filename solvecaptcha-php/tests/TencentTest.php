<?php

namespace SolveCaptcha\Tests;

class TencentTest extends AbstractWrapperTestCase
{
    protected $method = 'tencent';

    public function testAllOptions()
    {
        $params = [
            'sitekey' => '123456789',
            'url'     => 'https://www.site.com/page/',
            'proxy'     => [
                'type' => 'HTTPS',
                'uri'  => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            ]
        ];

        $sendParams = [
            'method'    => 'tencent',
            'app_id'   => '123456789',
            'pageurl'   => 'https://www.site.com/page/',
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
