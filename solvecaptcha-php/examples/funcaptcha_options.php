<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha([
    'apiKey'	=> 'YOUR_API_KEY',
    'server'	=> 'https://solvecaptcha.com'
]);

try {
    $result = $solver->funcaptcha([
        'sitekey'   => '69A21A01-CC7B-B9C6-0F9A-E7FA06677FFC',
        'url'       => 'https://mysite.com/page/with/funcaptcha',
        'surl'      => 'https://client-api.arkoselabs.com',
        'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36',
        'data'      =>  '{"anyKey":"anyStringValue"}',
        'proxy'   => [
            'type' => 'HTTPS',
            'uri'  => 'login:password@IP_address:PORT',
        ],
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
