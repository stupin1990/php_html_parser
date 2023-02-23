<?php

namespace Src\Core\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;

class HttpHandler implements HttpHandlerInterface
{
    protected string $url;
    protected string $method;
    protected array $params;
    protected $responce;

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
            throw new \Exception('Invalid url format, should be: http[s]://example.com');
        }

        $this->url = $url;
        $this->method = $method;
        $this->params = $params;

        $this->responce = static::request($this->url, $this->method, $this->params);
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
                throw new \Exception('Page not found!');
            }
            throw new \Exception($e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $res;
    }

    public function getResponce() : Response
    {
        return $this->responce;
    }

    public function getContent() : string
    {
        $content_type = $this->responce->getHeader('Content-Type')[0];
        if (strpos($content_type, 'text/html') === false) {
            throw new \Exception('Content is not a text! (' . $content_type . ')');
        }

       return $this->responce->getBody()->getContents();
    }

    public function getJson() : array
    {
        $content_type = $this->responce->getHeader('Content-Type')[0];
        if (strpos($content_type, '/json') === false) {
            throw new \Exception('Content is not a json (' . $content_type . ')');
        }

        try {
            $content = json_decode($this->responce->getBody()->getContents(), true);
            return $content;
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getXml() : SimpleXMLElement
    {
        $content_type = $this->responce->getHeader('Content-Type')[0];
        if (strpos($content_type, '/xml') === false) {
            throw new \Exception('Content is not an xml! (' . $content_type . ')');
        }

        try {
            $content = simplexml_load_string($this->responce->getBody()->getContents());
            return $content;
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}