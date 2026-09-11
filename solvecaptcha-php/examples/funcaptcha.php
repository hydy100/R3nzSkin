<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha('YOUR_API_KEY');

try {
    $result = $solver->funcaptcha([
        'sitekey' => '69A21A01-CC7B-B9C6-0F9A-E7FA06677FFC',
        'url'     => 'https://mysite.com/page/with/funcaptcha',
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
