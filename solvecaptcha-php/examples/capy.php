<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha('YOUR_API_KEY');

try {
    $result = $solver->capy([
        'sitekey' => 'PUZZLE_Abc1dEFghIJKLM2no34P56q7rStu8v',
        'url'     => 'https://www.mysite.com/captcha/',
        'api_server' => 'https://jp.api.capy.me/'
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
