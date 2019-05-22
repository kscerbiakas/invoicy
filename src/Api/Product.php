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

        return $this->mapProductResponse(json_decode($publicProducts));
    }


    public function publicProductById($id)
    {
        $publicProduct = $this->client->get(sprintf('%s/public/projects/products/%s', $this->endpoint, $id));

        $publicProduct = json_decode($publicProduct);

        return new ProductEntity($publicProduct->data);
    }

    public function publicCategoryProducts($categoryId)
    {
        $publicCategoryProducts = $this->client->get(sprintf('%s/public/projects/categories/%s/products', $this->endpoint, $categoryId));

        return $this->mapProductResponse(json_decode($publicCategoryProducts));
    }

    public function publicSubcategoryProducts($subcategoryId)
    {
        $publicSubcategoryProducts = $this->client->get(sprintf('%s/public/projects/subcategories/%s/products', $this->endpoint, $subcategoryId));

        return $this->mapProductResponse(json_decode($publicSubcategoryProducts));
    }


    private function mapProductResponse($productsJson)
    {
        return array_map(function ($product) {
            $productConverted = new ProductEntity($product);
            $productConverted->category = $productConverted->category ? new CategoryEntity($productConverted->category) : null;
            $productConverted->subcategory = $productConverted->subcategory ? new SubcategoryEntity($productConverted->subcategory) : null;
            return $productConverted;
        }, $productsJson->data);
    }

}