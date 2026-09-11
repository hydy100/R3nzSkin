<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha([
    'apiKey'	=> 'YOUR_API_KEY',
    'server'	=> 'https://solvecaptcha.com'
]);

try {
    $result->code = $solver->lemin([
        'captchaId' => 'CROPPED_d3d4d56_73ca4008925b4f83a8bed59c2dd0df6d',
        'apiServer' => 'api.leminnow.com',
        'url'       => 'https://www.site.com/page/',
        'divId'     => 'lemin-cropped-captcha',
        'proxy'     => [
            'type' => 'HTTPS',
            'uri'  => 'login:password@IP_address:PORT',
        ],
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
