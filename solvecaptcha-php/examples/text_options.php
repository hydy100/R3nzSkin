<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha([
    'apiKey'	=> $argv[1], //YOUR_API_KEY
    'server'	=> 'https://solvecaptcha.com'
]);

try {
    $result = $solver->text([
        'textcaptcha' => 'If tomorrow is Saturday, what day is today?',
        'language' => '2',
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
