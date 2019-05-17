<?php

namespace Invoicy\Client;

interface InvoicyClientInterface
{

    /**
     * @param string $url
     * @return string
     * @throws HttpException
     */
    public function get(string $url);

}