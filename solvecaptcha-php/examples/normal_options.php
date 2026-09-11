<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha([
    'apiKey'	=> 'YOUR_API_KEY',
    'server'	=> 'https://solvecaptcha.com'
]);

try {
    $result = $solver->normal([
        'file'          => __DIR__ . '/images/normal_2.jpg',
        'numeric'       => 4,
        'minLen'        => 4,
        'maxLen'        => 20,
        'phrase'        => 1,
        'caseSensitive' => 1,
        'calc'          => 0,
        'lang'          => 'en',
     // 'hintImg'       => __DIR__ . '/images/normal_hint.jpg',
     // 'hintText'      => 'Type red symbols only',
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
