<?php

set_time_limit(610);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha([
    'apiKey'	=> 'YOUR_API_KEY',
    'server'	=> 'https://solvecaptcha.com'
]);

try {
    $result = $solver->yandex([
        'sitekey' => 'Y5Lh0tiycconMJGsFd3EbbuNKSp1yaZESUOIHfeV',
        'url'     => 'https://rutube.ru',
        'proxy'     => [
            'type' => 'HTTPS',
            'uri'  => 'login:password@IP_address:PORT',
        ],
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
