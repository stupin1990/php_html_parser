<?php

namespace Src\Core\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Request
{
    protected string $url;
    protected Client $client;

    public function __construct(string $url = '')
    {
        if (!$url) {
            throw new \Exception('Undefined url!');
        }

        preg_match("/(http[s]{0,1}\:\/\/.+)/", $url, $matches);

        if (!count($matches)) {
            throw new \Exception('Invalid url format, should be: http[s]://example.com');
        }

        $this->url = $url;
        $this->client = new Client;
    }

    protected function request($method = 'GET', $params = []) : string
    {
        if (!isset($params['connect_timeout'])) {
            $params['connect_timeout'] = 10;
        }

        try {
            $res = $this->client->request($method, $this->url, $params);
        } catch (ClientException $e) {
            if ($e->getResponse()->getStatusCode() == 404) {
                throw new \Exception('Page not found!');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $res->getBody()->getContents();
    }
}