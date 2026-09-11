<?php

namespace SolveCaptcha;

use Exception;
use SolveCaptcha\Exception\ApiException;
use SolveCaptcha\Exception\NetworkException;
use SolveCaptcha\Exception\TimeoutException;
use SolveCaptcha\Exception\ValidationException;

/**
 * Class SolveCaptcha
 * @package SolveCaptcha
 */
class SolveCaptcha
{
    /**
     * API KEY
     *
     * @string
     */
    private $apiKey;

    /**
     * API server URL: https://solvecaptcha.com (default)
     *
     * @string
     */
    private $server = 'https://solvecaptcha.com';

    /**
     * ID of software developer. Developers who integrated their software
     * with our service get reward: 10% of spendings of their software users.
     *
     * @integer
     */
    private $softId = 4585;

    /**
     * URL to which the result will be sent
     *
     * @string
     */
    private $callback;

    /**
     * How long should wait for captcha result (in seconds)
     *
     * @integer
     */
    private $defaultTimeout = 120;

    /**
     * How long should wait for recaptcha result (in seconds)
     *
     * @integer
     */
    private $recaptchaTimeout = 600;

    /**
     * How often do requests to `/res.php` should be made
     * in order to check if a result is ready (in seconds)
     *
     * @integer
     */
    private $pollingInterval = 10;

    /**
     * Helps to understand if there is need of waiting
     * for result or not (because callback was used)
     *
     * @integer
     */
    private $lastCaptchaHasCallback;

    /**
     * Network client
     *
     * @resource
     */
    private $apiClient;

    /**
     * JSON response
     */
    private $json = 0;

    /**
     * SolveCaptcha constructor.
     * @param $options string|array
     */
    public function __construct($options)
    {
        if (is_string($options)) {
            $options = [
                'apiKey' => $options,
            ];
        }

        if (!empty($options['server'])) $this->server = $options['server'];
        if (!empty($options['apiKey'])) $this->apiKey = $options['apiKey'];
        if (!empty($options['softId'])) $this->softId = $options['softId'];
        if (!empty($options['callback'])) $this->callback = $options['callback'];
        if (!empty($options['defaultTimeout'])) $this->defaultTimeout = $options['defaultTimeout'];
        if (!empty($options['recaptchaTimeout'])) $this->recaptchaTimeout = $options['recaptchaTimeout'];
        if (!empty($options['pollingInterval'])) $this->pollingInterval = $options['pollingInterval'];
        if (!empty($options['json'])) $this->json = $options['json'];


        $this->apiClient = new ApiClient($this->server);
    }

    public function setHttpClient($apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Wrapper for solving normal captcha (image)
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function normal($captcha)
    {
        if (is_string($captcha)) {
            $captcha = [
                'file' => $captcha,
            ];
        }

        $this->requireFileOrBase64($captcha);

        $captcha['method'] = empty($captcha['base64']) ? 'post' : 'base64';

        return $this->solve($captcha);
    }

    /**
     * Wrapper for solving text captcha
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function text($captcha)
    {
        if (is_string($captcha)) {
            $captcha = [
                'text' => $captcha,
            ];
        }

        $captcha['method'] = 'post';

        return $this->solve($captcha);
    }

    /**
     * Wrapper for solving ReCaptcha
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function recaptcha($captcha)
    {
        $captcha['method'] = 'userrecaptcha';

        return $this->solve($captcha, ['timeout' => $this->recaptchaTimeout]);
    }

    /**
     * Wrapper for solving Yandex
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function yandex($captcha)
    {
        $captcha['method'] = 'yandex';

        return $this->solve($captcha, ['timeout' => $this->recaptchaTimeout]);
    }

    /**
     * Wrapper for solving Turnstile
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function turnstile($captcha)
    {
        $captcha['method'] = 'turnstile';

        return $this->solve($captcha, ['timeout' => $this->recaptchaTimeout]);
    }

    /**
     * Wrapper for solving AmazonWaf
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function amazon_waf($captcha)
    {
        $captcha['method'] = 'amazon_waf';

        return $this->solve($captcha, ['timeout' => $this->recaptchaTimeout]);
    }

    /**
     * Wrapper for solving FunCaptcha
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function funcaptcha($captcha)
    {
        $captcha['method'] = 'funcaptcha';

        return $this->solve($captcha);
    }

    /**
     * Wrapper for solving GeeTest
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function geetest($captcha)
    {
        $captcha['method'] = 'geetest';

        return $this->solve($captcha);
    }

    /**
     * Wrapper for solving GeeTest V4
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function geetest_v4($captcha)
    {
        $captcha['method'] = 'geetest_v4';

        return $this->solve($captcha);
    }


    /**
     * Wrapper for solving Lemin
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function lemin($captcha)
    {
        $captcha['method'] = 'lemin';

        return $this->solve($captcha);
    }

    /**
     * Wrapper for solving KeyCaptcha
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function keycaptcha($captcha)
    {
        $captcha['method'] = 'keycaptcha';

        return $this->solve($captcha);
    }

    /**
     * Wrapper for solving Capy captcha
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function capy($captcha)
    {
        $captcha['method'] = 'capy';

        return $this->solve($captcha);
    }

    /**
     * Wrapper for solving Tencent
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function tencent($captcha)
    {
        $captcha['method'] = 'tencent';

        return $this->solve($captcha);
    }

    /**
     * Wrapper for solving MTCaptcha
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function mt_captcha($captcha)
    {
        $captcha['method'] = 'mt_captcha';

        return $this->solve($captcha);
    }

    /**
     * Wrapper for solving Cutcaptcha
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function cutcaptcha($captcha)
    {
        $captcha['method'] = 'cutcaptcha';

        return $this->solve($captcha);
    }

    /**
     * Wrapper for solving Friendly Captcha
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function friendly_captcha($captcha)
    {
        $captcha['method'] = 'friendly_captcha';

        return $this->solve($captcha);
    }

    /**
     * Wrapper for solving atbCAPTCHA
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function atb_captcha($captcha)
    {
        $captcha['method'] = 'atb_captcha';

        return $this->solve($captcha);
    }


    /**
     * Wrapper for solving DataDome
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function datadome($captcha)
    {
        $captcha['method'] = 'datadome';

        return $this->solve($captcha);
    }


    /**
     * Wrapper for solving grid captcha
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function grid($captcha)
    {
        if (is_string($captcha)) {
            $captcha = [
                'file' => $captcha,
            ];
        }

        $this->requireFileOrBase64($captcha);

        $captcha['method'] = empty($captcha['base64']) ? 'post' : 'base64';

        return $this->solve($captcha);
    }

    /**
     * Wrapper for solving canvas captcha
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function canvas($captcha)
    {
        if (is_string($captcha)) {
            $captcha = [
                'file' => $captcha,
            ];
        }

        $this->requireFileOrBase64($captcha);

        $captcha['method'] = empty($captcha['base64']) ? 'post' : 'base64';
        $captcha['recaptcha'] = 1;
        $captcha['canvas'] = 1;

        if (empty($captcha['hintText']) && empty($captcha['hintImg'])) {
            throw new ValidationException('At least one of parameters: hintText or hintImg required!');
        }

        return $this->solve($captcha);
    }

    /**
     * Wrapper for solving coordinates captcha
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function coordinates($captcha)
    {
        if (is_string($captcha)) {
            $captcha = [
                'file' => $captcha,
            ];
        }

        $this->requireFileOrBase64($captcha);

        $captcha['method'] = empty($captcha['base64']) ? 'post' : 'base64';
        $captcha['coordinatescaptcha'] = 1;

        return $this->solve($captcha);
    }

    /**
     * Wrapper for solving audio captcha
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function audio($captcha)
    {
        if (is_string($captcha)) {
            if (!file_exists($captcha)) {
                throw new ValidationException('File not found (' . $captcha . ')');
            }
            $body = file_get_contents($captcha);
            $body = base64_encode($body);

            $captcha = [
                'body' => $body,
            ];
        }

        $captcha['method'] = 'audio';
        return $this->solve($captcha);
    }

    /**
     * Wrapper for solving RotateCaptcha
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function rotate($captcha)
    {
        if (is_string($captcha)) {
            if (!file_exists($captcha)) {
                throw new ValidationException('File not found (' . $captcha . ')');
            }
            $body = file_get_contents($captcha);
            $body = base64_encode($body);
            $captcha = [
                'body' => $body,
            ];
        }

        $captcha['method'] = 'rotatecaptcha';
        return $this->solve($captcha);
    }

    /**
     * Wrapper for solving CyberSiARA
     *
     * @param $captcha
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function cybersiara($captcha)
    {
        $captcha['method'] = 'cybersiara';

        return $this->solve($captcha);
    }

    /**
     * Sends captcha to `/in.php` and waits for it's result.
     * This helper can be used insted of manual using of `send` and `getResult` functions.
     *
     * @param $captcha
     * @param array $waitOptions
     * @return \stdClass
     * @throws ApiException
     * @throws NetworkException
     * @throws TimeoutException
     * @throws ValidationException
     */
    public function solve($captcha, $waitOptions = [])
    {
        $result = new \stdClass();

        $result->captchaId = $this->send($captcha);

        if ($this->lastCaptchaHasCallback) return $result;

        $result->code = $this->waitForResult($result->captchaId, $waitOptions);

        return $result;
    }

    /**
     * This helper waits for captcha result, and when result is ready, returns it
     *
     * @param $id
     * @param array $waitOptions
     * @return string|null
     * @throws TimeoutException
     */
    public function waitForResult($id, $waitOptions = [])
    {
        $startedAt = time();

        $timeout = empty($waitOptions['timeout']) ? $this->defaultTimeout : $waitOptions['timeout'];
        $pollingInterval = empty($waitOptions['pollingInterval']) ? $this->pollingInterval : $waitOptions['pollingInterval'];

        while (true) {
            if (time() - $startedAt < $timeout) {
                sleep($pollingInterval);
            } else {
                break;
            }

            try {
                $code = $this->getResult($id);
                if ($code) return $code;
            } catch (NetworkException $e) {
                // ignore network errors
            } catch (Exception $e) {
                throw $e;
            }
        }

        throw new TimeoutException('Timeout ' . $timeout . ' seconds reached');
    }

    /**
     * Sends captcha to '/in.php', and returns its `id`
     *
     * @param $captcha
     * @return string
     * @throws ApiException
     * @throws NetworkException
     * @throws ValidationException
     */
    public function send($captcha)
    {
        $this->sendAttachDefaultParams($captcha);

        $files = $this->extractFiles($captcha);

        $this->mapParams($captcha, $captcha['method']);
        $this->mapParams($files, $captcha['method']);

        $response = $this->apiClient->in($captcha, $files);

        $jsonObj = json_decode($response, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            $request = $jsonObj['request'];
            $status = $jsonObj['status'];

            if ($request == "CAPCHA_NOT_READY") {
                return null;
            }

            if ($status == 1) {
                return $request;
            }
        } else {
            if (mb_strpos($response, 'OK|') !== 0) {
                throw new ApiException('Cannot recognise api response (' . $response . ')');
            }

            return mb_substr($response, 3);
        }
    }

    /**
     * Returns result of captcha if it was solved or `null`, if result is not ready
     *
     * @param $id
     * @return string|null
     * @throws ApiException
     * @throws NetworkException
     */
    public function getResult($id)
    {
        $response = $this->res([
            'action' => 'get',
            'id'     => $id,
            'json'   => $this->json,
        ]);
        $jsonObj = json_decode($response, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            $request = $jsonObj['request'];
            $status = $jsonObj['status'];


            if ($request == "CAPCHA_NOT_READY") {
                return null;
            }

            if ($status == 1) {
                return $response;
            }
        } else {

            if ($response == 'CAPCHA_NOT_READY') {
                return null;
            }

            if (mb_strpos($response, 'OK|') !== 0) {
                throw new ApiException('Cannot recognise api response (' . $response . ')');
            }

            return mb_substr($response, 3);
        }
    }

    /**
     * Gets account's balance
     *
     * @return float
     * @throws ApiException
     * @throws NetworkException
     */
    public function balance()
    {
        $response = $this->res('getbalance');

        return floatval($response);
    }

    /**
     * Reports if captcha was solved correctly (sends `reportbad` or `reportgood` to `/res.php`)
     *
     * @param $id
     * @param $correct
     * @throws ApiException
     * @throws NetworkException
     */
    public function report($id, $correct)
    {
        if ($correct) {
            $this->res(['id' => $id, 'action' => 'reportgood']);
        } else {
            $this->res(['id' => $id, 'action' => 'reportbad']);
        }
    }

    /**
     * Makes request to `/res.php`
     *
     * @param $query
     * @return bool|string
     * @throws ApiException
     * @throws NetworkException
     */
    private function res($query)
    {
        if (is_string($query)) {
            $query = ['action' => $query];
        }

        $query['key'] = $this->apiKey;

        return $this->apiClient->res($query);
    }

    /**
     * Attaches default parameters (passed in constructor) to request
     *
     * @param $captcha
     */
    private function sendAttachDefaultParams(&$captcha)
    {
        $captcha['key'] = $this->apiKey;
        $captcha['json'] = $this->json;

        if ($this->callback) {
            if (!isset($captcha['callback'])) {
                $captcha['callback'] = $this->callback;
            } else if (!$captcha['callback']) {
                unset($captcha['callback']);
            }
        }

        $this->lastCaptchaHasCallback = !empty($captcha['callback']);

        if ($this->softId and !isset($captcha['softId'])) {
            $captcha['softId'] = $this->softId;
        }
    }

    /**
     * Validates if files parameters are correct
     *
     * @param $captcha
     * @param string $key
     * @throws ValidationException
     */
    private function requireFileOrBase64($captcha, $key = 'file')
    {
        if (!empty($captcha['base64'])) return;

        if (empty($captcha[$key])) {
            throw new ValidationException('File required');
        }

        if (!file_exists($captcha[$key])) {
            throw new ValidationException('File not found (' . $captcha[$key] . ')');
        }
    }

    /**
     * Turns `files` parameter into `file_1`, `file_2`, `file_n` parameters
     *
     * @param $captcha
     * @throws ValidationException
     */
    private function prepareFilesList(&$captcha)
    {
        $filesLimit = 9;
        $i = 0;

        foreach ($captcha['files'] as $file) {
            if (++$i > $filesLimit) {
                throw new ValidationException('Too many files (max: ' . $filesLimit . ')');
            }

            if (!file_exists($file)) {
                throw new ValidationException('File not found (' . $file . ')');
            }

            $captcha['file_' . $i] = $file;
        }

        unset($captcha['files']);
    }

    /**
     * Extracts files into separate array
     *
     * @param $captcha
     * @return array
     */
    private function extractFiles(&$captcha)
    {
        $files = [];

        $fileKeys = ['file', 'hintImg'];

        for ($i = 1; $i < 10; $i++) {
            $fileKeys[] = 'file_' . $i;
        }

        foreach ($fileKeys as $key) {
            if (!empty($captcha[$key]) and is_file($captcha[$key])) {
                $files[$key] = $captcha[$key];
                unset($captcha[$key]);
            }
        }

        return $files;
    }

    /**
     * Turns passed parameters names into API-specific names
     *
     * @param $params
     */
    private function mapParams(&$params, $method)
    {
        $map = $this->getParamsMap($method);

        foreach ($map as $new => $old) {
            if (isset($params[$new])) {
                $params[$old] = $params[$new];
                unset($params[$new]);
            }
        }

        if (isset($params['proxy'])) {
            $proxy = $params['proxy'];
            $params['proxy'] = $proxy['uri'];
            $params['proxytype'] = $proxy['type'];
        }
    }

    /**
     * Contains rules for `mapParams` method
     *
     * @param $method
     * @return array
     */
    private function getParamsMap($method)
    {
        $commonMap = [
            'base64'        => 'body',
            'caseSensitive' => 'regsense',
            'minLen'        => 'min_len',
            'maxLen'        => 'max_len',
            'hintText'      => 'textinstructions',
            'hintImg'       => 'imginstructions',
            'url'           => 'pageurl',
            'score'         => 'min_score',
            'text'          => 'textcaptcha',
            'rows'          => 'recaptcharows',
            'cols'          => 'recaptchacols',
            'previousId'    => 'previousID',
            'canSkip'       => 'can_no_answer',
            'apiServer'     => 'api_server',
            'softId'        => 'soft_id',
            'callback'      => 'pingback',
            'captchaId'     => 'captcha_id',
            'divId'         => 'div_id'
        ];

        $methodMap = [
            'userrecaptcha' => [
                'sitekey' => 'googlekey',
            ],
            'funcaptcha' => [
                'sitekey' => 'publickey',
            ],
            'capy' => [
                'sitekey' => 'captchakey',
            ],
            'tencent' => [
                'sitekey' => 'app_id',
            ],
            'atb_captcha' => [
                'sitekey' => 'app_id',
            ],
        ];

        if (isset($methodMap[$method])) {
            return array_merge($commonMap, $methodMap[$method]);
        }

        return $commonMap;
    }

    /**
     * Helper to determine if array is associative or not
     *
     * @param $arr
     * @return bool
     */
    private function isArrayAssoc($arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}
