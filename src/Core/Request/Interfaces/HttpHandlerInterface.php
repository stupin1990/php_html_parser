<?php

namespace Src\Core\Request\Interfaces;

use GuzzleHttp\Psr7\Response;
use Src\Core\Request\ResponseDTO;

interface HttpHandlerInterface
{
     /**
     * Make url request and return response
     * @param string $url - url address string
     * @param string $method - request type GET, POST...
     * @param array $params - additional request params
     * @return GuzzleHttp\Psr7\Response;
     */
    public static function request(string $url, string $method, array $params = []) : Response;

    /**
     * Get Response object
     * @return GuzzleHttp\Psr7\Response
     */
    public function getResponse() : ResponseDTO;

    /**
     * Get text data from response
     * @return string with content body
     */
    public function getContent() : string;

    /**
     * Get json data from response
     * @return array decoded json data
     */
    public function getJson() : array;

    /**
     * Get xml data from response
     * @return SimpleXMLElement object
     */
    public function getXml() : \SimpleXMLElement;
}