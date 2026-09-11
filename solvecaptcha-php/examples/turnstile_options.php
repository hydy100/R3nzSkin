<?php

set_time_limit(610);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha([
    'apiKey'	=> 'YOUR_API_KEY',
    'server'	=> 'https://solvecaptcha.com'
]);

try {
    $result = $solver->turnstile([
        'sitekey' => '0x4AAAAAAAChNiVJM_WtShFf',
        'url'     => 'https://ace.fusionist.io',
        'data'    => 'Test-data_rvghbjnoiu8y7tfvgbhnj',
        'action'  => 'test',
        'proxy'   => [
            'type' => 'HTTPS',
            'uri'  => 'login:password@IP_address:PORT',
        ],
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
