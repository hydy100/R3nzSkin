<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha([
    'apiKey'	=> $argv[1],
    'server'	=> 'https://solvecaptcha.com'
]);

$imginstructionsFile = __DIR__ . '/images/grid_hint.jpg';
$imginstructionsFileBase64 = base64_encode(file_get_contents($imginstructionsFile));

try {
    $result = $solver->grid([
        'file'       => __DIR__ . '/images/grid_2.jpg',
        'rows'       =>	3,
        'cols'       =>	3,
        'previousId' =>	0,        
        'lang'       =>	'en',
        'imginstructions' => $imginstructionsFileBase64,
        //'textinstructions'   =>	'Select all images with an Orange',
        'recaptcha' => 1
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
