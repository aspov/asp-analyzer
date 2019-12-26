<?php

namespace Tests;

use Psr\Http\Message\RequestInterface;

class TestClient implements \GuzzleHttp\ClientInterface
{
    private $domain;
    private $statusCode = 200;
    private $contentLength = [999];
    private $body = "test body 
    <meta name=\"keywords\" content=\"test_keyword\">
    <meta name=\"description\" content=\"test_description\">
    <h1>test_h1<\h1>";

    public function __construct($domain)
    {
        $this->domain = $domain;
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
        return new TestClient($this->domain);
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
        return new TestClient($this->domain);
    }

    public function getHeaders()
    {
        return ['Content-Length' => $this->contentLength];
    }
}
