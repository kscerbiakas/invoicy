<?php

namespace Invoicy\Api;

use Invoicy\Client\InvoicyClientInterface;

abstract class AbstractApi
{

    /**
     * @var InvoicyClientInterface
     */
    protected $client;

    /**
     * @var
     */
    protected $endpoint;


    public function __construct(InvoicyClientInterface $client)
    {
        if (config('invoicy.endpoint') == '') {
            throw new InvalidArgumentException('Invoicy endpoint in config file not set!');
        }
        $this->client = $client;
        $this->endpoint = config('invoicy.endpoint');

    }
}