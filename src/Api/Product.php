<?php

namespace Invoicy\Api;

use Invoicy\Api\AbstractApi;
use Invoicy\Entity\CategoryEntity;
use Invoicy\Entity\ProductEntity;
use Invoicy\Entity\SubcategoryEntity;

class Product extends AbstractApi
{
    public function publicProjectProducts()
    {
        $publicProducts = $this->client->get(sprintf('%s/public/projects/products/', $this->endpoint));

        $publicProducts = json_decode($publicProducts);
        return array_map(function ($product) {
            $productConverted = new ProductEntity($product);
            $productConverted->category = $productConverted->category ? new CategoryEntity($productConverted->category) : null;
            $productConverted->subcategory = $productConverted->subcategory ? new SubcategoryEntity($productConverted->subcategory) : null;
            return $productConverted;
        }, $publicProducts->data);
    }
}