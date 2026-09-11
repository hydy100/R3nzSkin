<?php

namespace SolveCaptcha\Tests;

class AmazonWafTest extends AbstractWrapperTestCase
{
    protected $method = 'amazon_waf';

    public function testAllOptions()
    {
        $params = [
            'sitekey'  => 'AQIDAHjcYu/GjX+QlghicBgQ/7bFaQZ+m5FKCMDnO+vTbNg96AF5H1K/siwSLK7RfstKtN5bAAAAfjB8BgkqhkiG9w0BBwagbzBtAgEAMGgGCSqGSIb3DQEHATAeBglg',
            'pageurl'  => 'https://non-existent-example.execute-api.us-east-1.amazonaws.com',
            'iv'         => 'test_iv',
            'context'    => 'test_context',
            'proxy'    => [
                'type' => 'HTTPS',
                'uri'  => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            ]
        ];

        $sendParams = [
            'method'     => 'amazon_waf',
            'sitekey'    => 'AQIDAHjcYu/GjX+QlghicBgQ/7bFaQZ+m5FKCMDnO+vTbNg96AF5H1K/siwSLK7RfstKtN5bAAAAfjB8BgkqhkiG9w0BBwagbzBtAgEAMGgGCSqGSIb3DQEHATAeBglg',
            'pageurl'    => 'https://non-existent-example.execute-api.us-east-1.amazonaws.com',
            'iv'         => 'test_iv',
            'context'    => 'test_context',
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
