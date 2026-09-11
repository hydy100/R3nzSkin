<?php

namespace SolveCaptcha;

use SolveCaptcha\Exception\ApiException;
use SolveCaptcha\Exception\NetworkException;

class ApiClient
{
    /**
     * API server
     *
     * @var string
     */
    private $server;

    /**
     * ApiClient constructor.
     * @param $options string
     */
    public function __construct($options)
    {
        if (is_string($options)) {
            $this->server = $options;
        }
    }

    /**
     * Network client
     *
     * @resource
     */
    private $curl;


    /**
     * Sends captcha to /in.php
     *
     * @param $captcha
     * @param array $files
     * @return bool|string
     * @throws ApiException
     * @throws NetworkException
     */
    public function in($captcha, $files = [])
    {
        if (!$this->curl) $this->curl = curl_init();

        foreach ($files as $key => $file) {
            $captcha[$key] = $this->curlPrepareFile($file);
        }

        curl_setopt_array($this->curl, [
            CURLOPT_URL            => $this->server . '/in.php',
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_POST           => 1,
            CURLOPT_POSTFIELDS     => $captcha,
        ]);

        return $this->execute();
    }

    /**
     * Does request to /res.php
     *
     * @param $query
     * @return bool|string
     * @throws ApiException
     * @throws NetworkException
     */
    public function res($query)
    {
        if (!$this->curl) $this->curl = curl_init();

        $url = $this->server . '/res.php';

        if ($query) $url .= '?' . http_build_query($query);

        curl_setopt_array($this->curl, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_POST           => 0,
        ]);

        return $this->execute();
    }

    /**
     * Executes http request to api
     *
     * @return bool|string
     * @throws ApiException
     * @throws NetworkException
     */
    private function execute()
    {
        $response = curl_exec($this->curl);

        if (curl_errno($this->curl)) {
            throw new NetworkException(curl_error($this->curl));
        }

        if (strpos(json_encode($response), 'ERROR_') !== false) {
            throw new ApiException($response);
        }

        return $response;
    }

    /**
     * Different php versions have different approaches of sending files via CURL
     *
     * @param $file
     * @return \CURLFile|string
     */
    private function curlPrepareFile($file)
    {
        if (function_exists('curl_file_create')) { // php 5.5+
            return curl_file_create($file, mime_content_type($file), 'file');
        } else {
            return '@' . realpath($file);
        }
    }

    /**
     * Closes active CURL resource if it was created
     */
    public function __destruct()
    {
        if ($this->curl) {
            curl_close($this->curl);
        }
    }
}
