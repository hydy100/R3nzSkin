<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha([
    'apiKey'	=> 'YOUR_API_KEY',
    'server'	=> 'https://solvecaptcha.com'
]);

try {
    $result = $solver->capy([
        'sitekey' => 'PUZZLE_Abc1dEFghIJKLM2no34P56q7rStu8v',
        'url'     => 'http://mysite.com/',
        'api_server' => 'https://jp.api.capy.me/',
        'proxy'   => [
            'type' => 'HTTPS',
            'uri'  => 'login:password@IP_address:PORT',
        ],
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
