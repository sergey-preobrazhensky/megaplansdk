<?php

class MegaplanResponse
{
    private string $httpCode;
    private string $rawResponse;
    private string $exceptionMessage;
    private $data;

    /**
     * @param $data
     * @param string $rawResponse
     * @param string $httpCode
     * @param string $curlError
     */
    public function __construct($data, string $rawResponse, string $httpCode, string $exceptionMessage)
    {
        $this->data = $data;
        $this->rawResponse = $rawResponse;
        $this->httpCode = $httpCode;
        $this->exceptionMessage = $exceptionMessage;
    }

    /**
     * @return string
     */
    public function getHttpCode(): string
    {
        return $this->httpCode;
    }

    /**
     * @return string
     */
    public function getRawResponse(): string
    {
        return $this->rawResponse;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        if ($this->data && !(empty($this->data->error))) {
            $error = $this->data->error;
            if (!empty($this->data->error_description)) {
                $error .= ': '.$this->data->error_description;
            }

            return $error;
        }

        if ($this->exceptionMessage) {
            return $this->exceptionMessage;
        }

        return '';
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
