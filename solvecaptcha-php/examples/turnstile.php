<?php

set_time_limit(610);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha('YOUR_API_KEY');

try {
    $result = $solver->turnstile([
        'sitekey' => '0x4AAAAAAAChNiVJM_WtShFf',
        'url'     => 'https://ace.fusionist.io',
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
