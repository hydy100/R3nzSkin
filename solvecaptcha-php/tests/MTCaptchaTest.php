<?php

namespace SolveCaptcha\Tests;

class MTCaptchaTest extends AbstractWrapperTestCase
{
    protected $method = 'mt_captcha';

    public function testAllOptions()
    {
        $params = [
            'sitekey' => 'MTPublic-AbcDE1fgH',
            'url'     => 'https://www.site.com/page/',
            'proxy'     => [
                'type' => 'HTTPS',
                'uri'  => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            ]
        ];

        $sendParams = [
            'method'    => 'mt_captcha',
            'sitekey'   => 'MTPublic-AbcDE1fgH',
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
