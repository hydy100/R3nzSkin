<?php

set_time_limit(610);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \SolveCaptcha\SolveCaptcha([
    'apiKey'	=> $argv[1], //YOUR_API_KEY
    'server'	=> 'https://solvecaptcha.com'
]);

try {
    $result = $solver->recaptcha([
        'googlekey' => '6LfB5_IbAAAAAMCtsjEHEHKqcB9iQocwwxTiihJu',
        'url'       => 'https://mysite.com/page/with/recaptcha',
        'invisible' => 1,
        'proxy'     => [
            'type' => 'HTTPS',
            'uri'  => 'login:password@IP_address:PORT',
        ],
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
