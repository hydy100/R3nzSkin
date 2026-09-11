<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha([
    'apiKey'	=> 'YOUR_API_KEY',
    'server'	=> 'https://solvecaptcha.com'
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://launches.endclothing.com/distil_r_captcha_challenge");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$resp = curl_exec($ch);
$challenge = explode(";", $resp)[0];

try {
    $result = $solver->geetest([
        'gt'        => 'f2ae6cadcf7886856696502e1d55e00c',
        'apiServer' => 'api-na.geetest.com',
        'challenge' => $challenge,
        'url'       => 'https://launches.endclothing.com/distil_r_captcha.html',
        'proxy'     => [
            'type' => 'HTTPS',
            'uri'  => 'login:password@IP_address:PORT',
        ],
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
