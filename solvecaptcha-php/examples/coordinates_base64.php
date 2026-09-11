<?php

set_time_limit(130);

require(__DIR__ . '/../src/autoloader.php');

$image = __DIR__ . '/images/grid.jpg';
$base64 = base64_encode(file_get_contents($image));

$solver = new \SolveCaptcha\SolveCaptcha('YOUR_API_KEY');

try {
    $result = $solver->coordinates(['base64' => $base64]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
