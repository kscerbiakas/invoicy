<?php

namespace Invoicy;

use Invoicy\Api\Product;
use Invoicy\Client\InvoicyClientInterface;

class InvoicyApi
{
    protected $client;


    public function __construct(InvoicyClientInterface $client)
    {
        $this->client = $client;
    }

    public function product()
    {
        return new Product($this->client);
    }

}