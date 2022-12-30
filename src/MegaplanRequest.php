<?php

include 'MegaplanResponse.php';

class MegaplanRequest
{
    private string $host;
    private string $token;
    private logger\LoggerInterface $logger;

    /**
     * @param string $host
     * @param string $token
     */
    public function __construct(string $host, string $token, logger\LoggerInterface $logger)
    {
        $this->host = $host;
        $this->token = $token;
        $this->logger = $logger;
    }

    public function get($url, $params = [], $headers = []): MegaplanResponse
    {
        $url .= $params ? '?'.rawurlencode(json_encode($params)) : '';

        return $this->send($url, 'GET', [], $headers);
    }

    public function post($url, $params = [], $headers = []): MegaplanResponse
    {
        return $this->send($url, 'POST', $params, $headers);
    }

    public function delete($url, $params = [], $headers = []): MegaplanResponse
    {
        return $this->send($url, 'DELETE', $params, $headers);
    }

    public function send($url, $type = 'GET', $params = [], $headers = [])
    {
        $httpCode = 0;
        $rawResponse = '';
        $exceptionMessage = '';
        $data = new stdClass();

        $headers = array_merge([
            'AUTHORIZATION: Bearer '.$this->token,
            'content-type: application/json',
        ], $headers);

        try {
            list($httpCode, $rawResponse) = $this->doRequest($type, $this->host.$url, $params, $headers);
            $data = json_decode($rawResponse);
            $this->logger->info('data', $data);
        } catch (Exception $e) {
            $exceptionMessage = $e->getMessage();
        }

        return new MegaplanResponse(
            $data,
            $rawResponse,
            $httpCode,
            $exceptionMessage,
        );
    }

    /**
     * @throws Exception
     *
     * @param mixed $type
     * @param mixed $url
     * @param mixed $params
     * @param mixed $headers
     */
    private function doRequest($type, $url, $params, $headers)
    {
        $this->logger->info('request', [
           'url' => $url,
           'type' => $type,
           'params' => $params,
           'headers' => $headers,
        ]);
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://'.$url);
            if ('POST' === $type) {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
            }
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $content = curl_exec($ch);
            if (false === $content) {
                throw new Exception(curl_error($ch), curl_errno($ch));
            }
            $this->logger->info('response', $content);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $this->logger->info('HTTP_CODE', $httpCode);
        } catch (Exception $e) {
            if (is_resource($ch)) {
                curl_close($ch);
            }
            $this->logger->error('ERROR', $e->getMessage());
            throw $e;
        }

        return [$httpCode, $content];
    }
}
