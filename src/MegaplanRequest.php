<?php

include 'MegaplanResponse.php';

class MegaplanRequest
{
    const MAX_INCLUDED_DEEP = 5;

    /**
     * @param string $host
     * @param string $token
     */
    public function __construct(
        private string $host,
        private string $token,
        private logger\LoggerInterface $logger,
        private bool $includedResponse = true
    )
    {
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
            $this->includedResponse ? 'X-USE-INCLUDED-RESPONSE: true' : '',
        ], $headers);

        try {
            list($httpCode, $rawResponse) = $this->doRequest($type, $this->host.$url, $params, $headers);
            $data = json_decode($rawResponse);
            if (!empty($data->data) && !empty($data->included)) {
                $includedByType = $this->getIncludedByType($data->included);
                $data->data = $this->processIncluded($data->data, $includedByType);
            }
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

    private function processIncluded($data, array $includedByType, $deep = 0)
    {
        $deep++;
        if ($deep > self::MAX_INCLUDED_DEEP || !is_array($data) && !is_object($data)) {
            return $data;
        }
        foreach ($data as $i => $item) {
            if (is_object($item) && count(get_object_vars($item)) === 2) {
                if (
                    !empty($item->contentType) &&
                    !empty($item->id) &&
                    !empty($includedByType[$item->contentType][$item->id])
                ) {
                    $item = $includedByType[$item->contentType][$item->id];
                }
            }
            if (is_array($data)) {
                $data[$i] = $this->processIncluded($item, $includedByType, $deep);
            } elseif (is_object($data)) {
                $data->$i = $this->processIncluded($item, $includedByType, $deep);
            }
        }

        return $data;
    }

    private function getIncludedByType($included)
    {
        $includedByType = [];
        foreach ($included as $object) {
            $includedByType[$object->contentType][$object->id] = $object;
        }

        return $includedByType;
    }
}
