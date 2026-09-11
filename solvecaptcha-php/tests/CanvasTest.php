<?php

namespace SolveCaptcha\Tests;

class CanvasTest extends AbstractWrapperTestCase
{
    protected $method = 'canvas';

    private $captchaImg = __DIR__ . '/../examples/images/canvas.jpg';
    private $hintText = 'Draw around apple';

    // public function testSingleFile()
    // {
    //     $this->checkIfCorrectParamsSendAndResultReturned([
    //         'params'     => $this->captchaImg,
    //         'sendParams' => ['method' => 'post', 'canvas' => 1],
    //         'sendFiles'  => ['file' => $this->captchaImg],
    //     ]);
    // }

    public function testSingleFileParameter()
    {
        $this->checkIfCorrectParamsSendAndResultReturned([
            'params'     => ['file' => $this->captchaImg, 'hintText' => $this->hintText],
            'sendParams' => ['method' => 'post', 'canvas' => 1, 'recaptcha' => 1, 'textinstructions' => $this->hintText, 'soft_id' => '4585', 'json' => '0'],
            'sendFiles'  => ['file' => $this->captchaImg],
        ]);
    }

    public function testBase64()
    {
        $this->checkIfCorrectParamsSendAndResultReturned([
            'params'     => ['base64' => '...', 'hintText' => $this->hintText],
            'sendParams' => ['method' => 'base64', 'canvas' => 1, 'body' => '...', 'recaptcha' => 1, 'textinstructions' => $this->hintText, 'soft_id' => '4585', 'json' => '0'],
            'sendFiles'  => [],
        ]);
    }

    public function testAllParameters()
    {
        $hintImg = __DIR__ . '/../examples/images/canvas_hint.jpg';

        $params = [
            'file'       => $this->captchaImg,
            'previousId' =>	0,
            'canSkip'    =>	0,
            'lang'       =>	'en',
            'hintImg'    => $hintImg,
            'hintText'   =>	$this->hintText,
        ];

        $sendParams = [
            'method'           => 'post',
            'canvas'           => 1,
            'previousID'       => 0,
            'can_no_answer'    => 0,
            'lang'             => 'en',
            'recaptcha'        => 1,
            'textinstructions' => $this->hintText,
            'soft_id'          => '4585',
            'json'       => '0'
        ];

        $sendFiles = [
            'file'            => $this->captchaImg,
            'imginstructions' => $hintImg,
        ];

        $this->checkIfCorrectParamsSendAndResultReturned([
            'params'     => $params,
            'sendParams' => $sendParams,
            'sendFiles'  => $sendFiles,
        ]);
    }

    public function testNormalFileException()
    {
        $this->checkIfExceptionThrownOnInvalidFile();
    }
}
