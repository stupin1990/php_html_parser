<?php

namespace Src\Core\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use Src\Core\Validator\ResponseValidator;

class HttpHandler implements Interfaces\HttpHandlerInterface
{
    protected string $url;
    protected string $method;
    protected array $params;
    protected ResponseDTO $responseDTO;

    /**
     * @param string $url - url address string
     * @param string $method - request type GET, POST...
     * @param array $params - additional request params
     */
    public function __construct(string $url = '', string $method = 'GET', array $params = [], ResponseDTO $dto = null)
    {
        if (!is_null($dto)) {
            $this->responseDTO = $dto;
            return;
        }

        if (!$url) {
            throw new \Exception('Undefined url!');
        }

        preg_match("/(http[s]{0,1}\:\/\/.+)/", $url, $matches);

        if (!count($matches)) {
            die('Invalid url format, should be: http[s]://example.com');
        }

        $this->url = $url;
        $this->method = $method;
        $this->params = $params;

        $response = static::request($this->url, $this->method, $this->params);
        $this->responseDTO = new responseDTO($response);
    }

    public static function request(string $url, string $method = 'GET', array $params = []) : Response
    {
        if (!isset($params['connect_timeout'])) {
            $params['connect_timeout'] = 10;
        }

        $client = new Client;

        try {
            $res = $client->request($method, $url, $params);
        } catch (ClientException $e) {
            if ($e->getResponse()->getStatusCode() == 404) {
                die('Page not found!');
            }
            throw new \Exception($e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $res;
    }

    public function getResponse() : ResponseDTO
    {
        return $this->responseDTO;
    }

    public function getContent() : string
    {
        ResponseValidator::validate($this->getResponse(), 'text');

        return $this->getResponse()->body;
    }

    public function getJson() : array
    {
        ResponseValidator::validate($this->getResponse(), 'json');

        return json_decode($this->getResponse()->body, true);;
    }

    public function getXml() : \SimpleXMLElement
    {
        ResponseValidator::validateXml($this->getResponse(), 'xml');

        return simplexml_load_string($this->getResponse()->body);
    }

}