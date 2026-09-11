<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha('YOUR_API_KEY');

try {
    $result = $solver->mt_captcha([
        'sitekey' => 'MTPublic-KzqLY1cKH',
        'url'     => 'https://solvecaptcha.com/demo/mtcaptcha',
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
