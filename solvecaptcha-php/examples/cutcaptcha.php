<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha('YOUR_API_KEY');

try {
    $result = $solver->cutcaptcha([
        'misery_key' => 'a1488b66da00bf332a1488993a5443c79047e752',
        'api_key'    => 'SAb83IIB',
        'url'        => 'https://example.cc/foo/bar.html',
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
