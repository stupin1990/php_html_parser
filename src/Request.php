<?php

namespace Src;

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

    protected function get() : string
    {
        try {
            $res = $this->client->request('GET', $this->url, ['connect_timeout' => 10]);
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