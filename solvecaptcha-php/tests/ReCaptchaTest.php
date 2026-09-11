<?php

namespace SolveCaptcha\Tests;

class ReCaptchaTest extends AbstractWrapperTestCase
{
    protected $method = 'recaptcha';

    public function testV2()
    {
        $params = [
            'sitekey'   => '6Le-wvkSVVABCPBMRTvw0Q4Muexq1bi0DJwx_mJ-',
            'url'       => 'https://mysite.com/page/with/recaptcha',
            'invisible' => 1,
            'action'    => 'verify',
            'proxy'     => [
                'type' => 'HTTPS',
                'uri'  => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            ]
        ];

        $sendParams = [
            'method'    => 'userrecaptcha',
            'googlekey' => '6Le-wvkSVVABCPBMRTvw0Q4Muexq1bi0DJwx_mJ-',
            'pageurl'   => 'https://mysite.com/page/with/recaptcha',
            'invisible' => 1,
            'action'    => 'verify',
            'proxy'     => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            'proxytype' => 'HTTPS',
            'soft_id'   => '4585',
            'json'      => '0'
        ];

        $this->checkIfCorrectParamsSendAndResultReturned([
            'params'     => $params,
            'sendParams' => $sendParams,
            'sendFiles'  => [],
        ]);
    }

    public function testV3()
    {
        $params = [
            'sitekey' => '6Le-wvkSVVABCPBMRTvw0Q4Muexq1bi0DJwx_mJ-',
            'url'     => 'https://mysite.com/page/with/recaptcha',
            'version' => 'v3',
            'action'  => 'verify',
            'score'   => 0.3,
        ];

        $sendParams = [
            'method'    => 'userrecaptcha',
            'googlekey' => '6Le-wvkSVVABCPBMRTvw0Q4Muexq1bi0DJwx_mJ-',
            'pageurl'   => 'https://mysite.com/page/with/recaptcha',
            'version'   => 'v3',
            'action'    => 'verify',
            'min_score' => 0.3,
            'soft_id'   => '4585',
            'json'      => '0'
        ];

        $this->checkIfCorrectParamsSendAndResultReturned([
            'params'     => $params,
            'sendParams' => $sendParams,
            'sendFiles'  => [],
        ]);
    }
}
