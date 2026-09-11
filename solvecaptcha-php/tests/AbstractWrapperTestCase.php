<?php

namespace SolveCaptcha\Tests;

use SolveCaptcha\ApiClient;
use SolveCaptcha\Exception\ValidationException;
use SolveCaptcha\SolveCaptcha;
use PHPUnit\Framework\TestCase;

abstract class AbstractWrapperTestCase extends TestCase
{
    protected $method;

    /**
     * This method sends captcha options through wrapper method,
     * checks if correct parameters were passed to ApiClient
     * and then checks if expected result were returned.
     *
     * @param $data
     */
    protected function checkIfCorrectParamsSendAndResultReturned($data)
    {
        $apiKey     = 'API_KEY';
        $captchaId  = '123';
        $code       = '2763';
        $json       = '0';

        $apiClient = $this->createMock(ApiClient::class);

        $data['sendParams']['key'] = $apiKey;

        $apiClient
            ->expects($this->once())
            ->method('in')
            ->with(
                $this->equalTo($data['sendParams']),
                $this->equalTo($data['sendFiles'])
            )
            ->willReturn('OK|' . $captchaId);

        $apiClient
            ->expects($this->once())
            ->method('res')
            ->with($this->equalTo(['action' => 'get', 'id' => $captchaId, 'key' => $apiKey, 'json' => $json]))
            ->willReturn('OK|' . $code);

        $solver = new SolveCaptcha([
            'apiKey' => $apiKey,
            'pollingInterval' => 1,
        ]);

        $solver->setHttpClient($apiClient);

        $result = $solver->{$this->method}($data['params']);

        $this->assertIsObject($result);
        $this->assertObjectHasProperty('code', $result);
        $this->assertEquals($result->code, $code);
    }

    /**
     * Pass invalid file parameter to wrapper method
     * in order to trigger ValidationException
     */
    protected function checkIfExceptionThrownOnInvalidFile()
    {
        $this->expectException(ValidationException::class);

        $solver = new SolveCaptcha('API_KEY');

        $result = $solver->{$this->method}([
            'file' => 'non-existent-file',
        ]);
    }

    /**
     * Pass invalid file parameter to wrapper method
     * in order to trigger ValidationException
     */
    protected function checkIfExceptionThrownOnTooManyFiles()
    {
        $this->expectException(ValidationException::class);

        $files = [];

        for ($i = 0; $i < 10; $i++) {
            $files[] = __DIR__ . '/../../examples/images/rotate.jpg';
        }

        $solver = new SolveCaptcha('API_KEY');

        $result = $solver->{$this->method}($files);
    }
}
