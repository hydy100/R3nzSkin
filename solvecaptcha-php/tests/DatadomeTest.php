<?php

namespace SolveCaptcha\Tests;

class DataDomeTest extends AbstractWrapperTestCase
{
    protected $method = 'datadome';

    public function testAllOptions()
    {
        $params = [
            'captcha_url' => 'https://geo.captcha-delivery.com/captcha/?initialCid=AHrlqAAA...P~XFrBVptk&t=fe&referer=https%3A%2F%2Fhexample.com&s=45239&e=c538be..c510a00ea',
            'userAgent'   => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
            'url'         => 'https://example.com/',
            'proxy'       => [
                'type' => 'HTTPS',
                'uri'  => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            ],
        ];

        $sendParams = [
            'method'      => 'datadome',
            'captcha_url' => 'https://geo.captcha-delivery.com/captcha/?initialCid=AHrlqAAA...P~XFrBVptk&t=fe&referer=https%3A%2F%2Fhexample.com&s=45239&e=c538be..c510a00ea',
            'userAgent'   => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
            'pageurl'     => 'https://example.com/',
            'proxy'       => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            'proxytype'   => 'HTTPS',
            'soft_id'     => '4585',
            'json'       => '0'
        ];

        $this->checkIfCorrectParamsSendAndResultReturned([
            'params'     => $params,
            'sendParams' => $sendParams,
            'sendFiles'  => [],
        ]);
    }
}
