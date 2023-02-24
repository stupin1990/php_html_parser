<?php

namespace Src\Core\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use Src\Core\Validator\ResponseValidator as Validator;

class HttpHandler implements HttpHandlerInterface
{
    protected string $url;
    protected string $method;
    protected array $params;
    protected Response $response;

    /**
     * @param string $url - url address string
     * @param string $method - request type GET, POST...
     * @param array $params - additional request params
     */
    public function __construct(string $url = '', string $method = 'GET', array $params = [])
    {
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

        $this->response = static::request($this->url, $this->method, $this->params);
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

    public function getResponse() : Response
    {
        return $this->response;
    }

    public function getContent() : string
    {
        Validator::validateOrDie($this->response, 'text');

        return $this->response->getBody()->getContents();
    }

    public function getJson() : array
    {
        Validator::validateOrDie($this->response, 'json');

        $content = json_decode($this->response->getBody()->getContents(), true);
        return $content;
    }

    public function getXml() : SimpleXMLElement
    {
        Validator::validateOrDie($this->response, 'xml');

        $content = simplexml_load_string($this->response->getBody()->getContents());
        return $content;
    }

}