<?php

namespace Tests;

use Psr\Http\Message\RequestInterface;

class TestClient implements \GuzzleHttp\ClientInterface
{
    private $body;
    private $statusCode = 200;

    public function __construct($body)
    {
        $this->body = $body;
    }
    
    public function sendAsync(RequestInterface $request, array $options = [])
    {
    }
    
    public function send(RequestInterface $request, array $options = [])
    {
    }
   
    public function requestAsync($method, $uri = '', array $options = [])
    {
    }
    
    public function request($method, $uri = '', array $options = [])
    {
        return new TestClient($this->body);
    }
    
    public function getConfig($option = null)
    {
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getHeader($header)
    {
        return $this->contentLength;
    }

    public function getContents()
    {
        return $this->body;
    }

    public function getBody()
    {
        return new TestClient($this->body);
    }

    public function getHeaders()
    {
        $utf8Body = iconv(mb_detect_encoding($this->body), "UTF-8//TRANSLIT", $this->body);
        return ['Content-Length' => mb_strlen($utf8Body, 'UTF-8')];
    }
}
