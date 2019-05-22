<?php

namespace Invoicy;

use Invoicy\Api\Category;
use Invoicy\Api\Product;
use Invoicy\Api\Subcategory;
use Invoicy\Client\InvoicyClientInterface;

class InvoicyApi
{
    /**
     * @var InvoicyClientInterface
     */
    protected $client;


    public function __construct(InvoicyClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return Product
     */
    public function product()
    {
        return new Product($this->client);
    }

    /**
     * @return Category
     */
    public function category()
    {
        return new Category($this->client);
    }

    /**
     * @return Subcategory
     */
    public function subcategory()
    {
        return new Subcategory($this->client);
    }


}