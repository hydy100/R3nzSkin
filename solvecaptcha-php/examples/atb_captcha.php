<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha('YOUR_API_KEY');

try {
    $result = $solver->atb_captcha([
        'sitekey'     => 'af23e041b22d000a11e22a230fa8991c',
        'api_server' => 'https://cap.aisecurius.com',
        'url'        => 'https://example.com/',
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
