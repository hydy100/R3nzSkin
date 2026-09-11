<?php

namespace SolveCaptcha\Tests;

class CyberSiaraTest extends AbstractWrapperTestCase
{
    protected $method = 'cybersiara';

    public function testAllOptions()
    {
        $params = [
            'master_url_id' => 'tpjOCKjjpdzv3d8Ub2E9COEWKt1vl1Mv',
            'pageurl' => 'https://demo.mycybersiara.com/',
            'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36',
            'proxy'    => [
                'type' => 'HTTPS',
                'uri'  => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            ]
        ];

        $sendParams = [
            'method'     => 'cybersiara',
            'master_url_id' => 'tpjOCKjjpdzv3d8Ub2E9COEWKt1vl1Mv',
            'pageurl' => 'https://demo.mycybersiara.com/',
            'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36',
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
