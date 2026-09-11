<?php

namespace SolveCaptcha\Tests;

class KeyCaptchaTest extends AbstractWrapperTestCase
{
    protected $method = 'keycaptcha';

    public function testAllOptions()
    {
        $params = [
            's_s_c_user_id'          => 10,
            's_s_c_session_id'       => '493e52c37c10c2bcdf4a00cbc9ccd1e8',
            's_s_c_web_server_sign'  => '9006dc725760858e4c0715b835472f22-pz-',
            's_s_c_web_server_sign2' => '2ca3abe86d90c6142d5571db98af6714',
            'url'                    => 'https://www.keycaptcha.ru/demo-magnetic/',
            'proxy'     => [
                'type' => 'HTTPS',
                'uri'  => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            ]
        ];

        $sendParams = [
            'method'                 => 'keycaptcha',
            's_s_c_user_id'          => 10,
            's_s_c_session_id'       => '493e52c37c10c2bcdf4a00cbc9ccd1e8',
            's_s_c_web_server_sign'  => '9006dc725760858e4c0715b835472f22-pz-',
            's_s_c_web_server_sign2' => '2ca3abe86d90c6142d5571db98af6714',
            'pageurl'                => 'https://www.keycaptcha.ru/demo-magnetic/',
            'proxy'                  => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
            'proxytype'              => 'HTTPS',
            'soft_id'                => '4585',
            'json'       => '0'
        ];

        $this->checkIfCorrectParamsSendAndResultReturned([
            'params'     => $params,
            'sendParams' => $sendParams,
            'sendFiles'  => [],
        ]);
    }
}
