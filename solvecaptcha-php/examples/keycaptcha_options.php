<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha([
    'apiKey'	=> 'YOUR_API_KEY',
    'server'	=> 'https://solvecaptcha.com'
]);

try {
    $result->code = $solver->keycaptcha([
        's_s_c_user_id'          => 10,
        's_s_c_session_id'       => '493e52c37c10c2bcdf4a00cbc9ccd1e8',
        's_s_c_web_server_sign'  => '9006dc725760858e4c0715b835472f22-pz-',
        's_s_c_web_server_sign2' => '2ca3abe86d90c6142d5571db98af6714',
        'pageurl'                => 'https://www.keycaptcha.ru/demo-magnetic/',
        'proxy'                  => [
            'type' => 'HTTPS',
            'uri'  => 'login:password@IP_address:PORT',
        ],
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
