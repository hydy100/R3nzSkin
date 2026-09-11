<?php

namespace SolveCaptcha\Tests;

class GeeTestV4 extends AbstractWrapperTestCase
{
    protected $method = 'geetest_v4';

    public function testAllOptions()
    {
        $params = [
            'apiServer' => 'api-na.geetest.com',
            'url'       => 'https://launches.endclothing.com/distil_r_captcha.html',
            'captcha_id'=> '72bf15796d0b69c43867452fea615052',
            'proxy'     => [
                'type' => 'HTTPS',
                'uri'  => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            ]
        ];

        $sendParams = [
            'method'     => 'geetest_v4',
            'api_server' => 'api-na.geetest.com',
            'pageurl'    => 'https://launches.endclothing.com/distil_r_captcha.html',
            'captcha_id' => '72bf15796d0b69c43867452fea615052',
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
