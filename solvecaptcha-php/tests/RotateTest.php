<?php

namespace SolveCaptcha\Tests;

class RotateTest extends AbstractWrapperTestCase
{
    protected $method = 'rotate';

    public function testAllParameters()
    {
        $hintImg = __DIR__ . '/../examples/images/grid_hint.jpg';

        $params = [
            'base64' => '...',
            'angle'    => 40,
            'lang'     => 'en',
            'hintImg'  => $hintImg,
            'hintText' => 'Put the images in the correct way up',
        ];

        $sendParams = [
            'method'           => 'rotatecaptcha',
            'angle'            => 40,
            'lang'             => 'en',
            'textinstructions' => 'Put the images in the correct way up',
            'body'             => '...',
            'soft_id'          => '4585',
            'json'             => '0'
        ];

        $sendFiles = [
            'imginstructions' => $hintImg,
        ];

        $this->checkIfCorrectParamsSendAndResultReturned([
            'params'     => $params,
            'sendParams' => $sendParams,
            'sendFiles'  => $sendFiles,
        ]);
    }
}
