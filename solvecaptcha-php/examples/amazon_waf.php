<?php

set_time_limit(610);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha('YOUR_API_KEY');

try {
    $result = $solver->amazon_waf([
        'sitekey' => 'AQIDAHjcYu/GjX+QlghicBgQ/7bFaQZ+m5FKCMDnO+vTbNg96AF5H1K/siwSLK7RfstKtN5bAAAAfjB8BgkqhkiG9w0BBwagbzBtAgEAMGgGCSqGSIb3DQEHATAeBglg',
        'url'     => 'https://non-existent-example.execute-api.us-east-1.amazonaws.com',
        'iv'      => 'test_iv',
        'context' => 'test_context'
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
