<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha('YOUR_API_KEY');

try {
    $result = $solver->audio(__DIR__ . '/audio/audio-en.mp3');
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
