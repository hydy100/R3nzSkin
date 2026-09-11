<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha($argv[1]); //YOUR_API_KEY

try {
    $result = $solver->datadome([
        'captcha_url' => 'https://geo.captcha-delivery.com/captcha/?initialCid=AHrlqAAA...P~XFrBVptk&t=fe&referer=https%3A%2F%2Fhexample.com&s=45239&e=c538be..c510a00ea',
        'userAgent'   => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
        'url'         => 'https://example.com/',
        'proxy'       => [
            'type' => 'HTTPS',
            'uri'  => 'username:str0ngP@$$W0rd@1.2.3.4:4321',
        ],
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
