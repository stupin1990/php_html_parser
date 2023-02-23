<?php

namespace Src\Core\Request;

use GuzzleHttp\Psr7\Response;

interface HttpHandlerInterface
{
     /**
     * Make url request and return responce
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
    public function getResponce() : Response;

    /**
     * Get text data from responce
     * @return string with content body
     */
    public function getContent() : string;

    /**
     * Get json data from responce
     * @return array decoded json data
     */
    public function getJson() : array;

    /**
     * Get xml data from responce
     * @return SimpleXMLElement object
     */
    public function getXml() : SimpleXMLElement;
}