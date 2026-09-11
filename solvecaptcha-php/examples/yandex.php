<?php

set_time_limit(610);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha('YOUR_API_KEY');

try {
    $result = $solver->yandex([
        'sitekey' => 'Y5Lh0tiycconMJGsFd3EbbuNKSp1yaZESUOIHfeV',
        'url'     => 'https://rutube.ru',
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
