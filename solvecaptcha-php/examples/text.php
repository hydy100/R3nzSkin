<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha('YOUR_API_KEY' );

try {
    $result = $solver->text('If tomorrow is Saturday, what day is today?');
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
