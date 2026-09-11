<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha('YOUR_API_KEY');

// To bypass GeeTest first we need to get new challenge value
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://mysite.com/captcha_challenge");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$resp = curl_exec($ch);
$challenge = explode(";", $resp)[0];

// Then we are ready to make a call to solvecaptcha API
try {
    $result = $solver->geetest([
        'gt'        => 'f2ae6cadcf7886856696502e1d55e00c',
        'apiServer' => 'api-na.geetest.com',
        'challenge' => $challenge,
        'url'       => 'https://mysite.com/captcha.html',
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
