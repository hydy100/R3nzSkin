<?php

namespace SolveCaptcha\Tests;

class FriendlyCaptchaTest extends AbstractWrapperTestCase
{
    protected $method = 'friendly_captcha';

    public function testAllOptions()
    {
        $params = [
            'sitekey' => '2FZFEVS1FZCGQ9',
            'url'     => 'https://example.com/',
            'proxy'   => [
                'type' => 'HTTPS',
                'uri'  => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            ]
        ];

        $sendParams = [
            'method'     => 'friendly_captcha',
            'sitekey'    => '2FZFEVS1FZCGQ9',
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
