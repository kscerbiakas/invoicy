<?php


namespace Invoicy\Api;

use Invoicy\Entity\CategoryEntity;

class Category extends AbstractApi
{
    public function publicCategories()
    {
        $publicCategories = $this->client->get(sprintf('%s/public/projects/product-categories', $this->endpoint));

        $publicCategories = json_decode($publicCategories);

        return array_map(function ($category) {
            return new CategoryEntity($category);
        }, $publicCategories->data);
    }

    public function publicCategoryById($id)
    {
        $publicCategory = $this->client->get(sprintf('%s/public/projects/product-categories/%s', $this->endpoint, $id));

        $publicCategory = json_decode($publicCategory);

        return new CategoryEntity($publicCategory->data);
    }
}