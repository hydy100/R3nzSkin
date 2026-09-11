<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha([
    'apiKey'	=> 'YOUR_API_KEY',
    'server'	=> 'https://solvecaptcha.com'
]);

try {
    $result = $solver->canvas([
        'file'       => __DIR__ . '/images/canvas.jpg',
        'previousId' =>	0,
        'canSkip'    =>	0,
        'lang'       =>	'en',
        'hintImg'    => __DIR__ . '/images/canvas_hint.jpg',
        'hintText' => 'Draw around apple',
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
