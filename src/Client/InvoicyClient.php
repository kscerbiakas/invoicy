<?php

namespace Invoicy\Client;

use Invoicy\Exception\HttpException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;


class InvoicyClient implements InvoicyClientInterface
{

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Response;
     */
    protected $response;

    public function __construct(array $headers)
    {
        $this->client = new Client(['headers' => $headers]);
    }

    public function get(string $url)
    {
        try {
            $this->response = $this->client->get($url);
        } catch (RequestException $e) {
            $this->response = $e->getResponse();
            $this->handleError();
        }

        return (string)$this->response->getBody();
    }


    /**
     * @throws HttpException
     */
    protected function handleError()
    {
        $body = (string)$this->response->getBody();
        $code = (int)$this->response->getStatusCode();
        $content = json_decode($body);
        throw new HttpException(isset($content->message) ? $content->message : 'Request not processed.', $code);
    }
}