<?php

use SolveCaptcha\SolveCaptcha;

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new SolveCaptcha([
    'apiKey'	=> 'YOUR_API_KEY',
    'server'	=> 'https://solvecaptcha.com'
]);

try {
    $result = $solver->cybersiara([
        'master_url_id' => 'tpjOCKjjpdzv3d8Ub2E9COEWKt1vl1Mv',
        'pageurl' => 'https://demo.mycybersiara.com/',
        'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36',
        'proxy'     => [
            'type' => 'HTTPS',
            'uri'  => 'login:password@IP_address:PORT',
        ],
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);