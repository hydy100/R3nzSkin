<?php

namespace SolveCaptcha\Tests;

class TextTest extends AbstractWrapperTestCase
{
    protected $method = 'text';

    public function testSimpleText()
    {
        $this->checkIfCorrectParamsSendAndResultReturned([
            'params'     => 'Today is monday?',
            'sendParams' => ['method' => 'post', 'textcaptcha' => 'Today is monday?','soft_id' => '4585','json' => '0'],
            'sendFiles'  => [],
        ]);
    }

    public function testTextParameter()
    {
        $this->checkIfCorrectParamsSendAndResultReturned([
            'params'     => ['text' => 'Today is monday?'],
            'sendParams' => ['method' => 'post', 'textcaptcha' => 'Today is monday?','soft_id' => '4585','json' => '0'],
            'sendFiles'  => [],
        ]);
    }

    public function testAllParameters()
    {
        $this->checkIfCorrectParamsSendAndResultReturned([
            'params'     => ['text' => 'Today is monday?', 'lang' => 'en'],
            'sendParams' => ['method' => 'post', 'textcaptcha' => 'Today is monday?', 'lang' => 'en','soft_id' => '4585','json' => '0'],
            'sendFiles'  => [],
        ]);
    }
}
