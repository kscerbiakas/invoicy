<?php

namespace Invoicy\Api;

use Invoicy\Entity\CategoryEntity;
use Invoicy\Entity\SubcategoryEntity;

class Subcategory extends AbstractApi
{
    public function publicSubcategoriesOfCategory($category)
    {
        $publicSubcategories = $this->client->get(sprintf('%s/public/projects/product-categories/%s/product-subcategories', $this->endpoint, $category));

        $publicSubcategories = json_decode($publicSubcategories);

        return array_map(function ($item) {
            $subcategory = new SubcategoryEntity($item);
            $subcategory->category = $subcategory->category ? new CategoryEntity($subcategory->category) : null;
            return $subcategory;
        }, $publicSubcategories->data);
    }

    public function publicSubcategoryByIdOfCategory($subcategoryId, $categoryId)
    {
        $publicSubcategory = $this->client->get(sprintf('%s/public/projects/product-categories/%s/product-subcategories/%s', $this->endpoint, $categoryId, $subcategoryId));

        $publicSubcategory = json_decode($publicSubcategory);

        $subcategoryEntity = new SubcategoryEntity($publicSubcategory->data);

        $subcategoryEntity->category = $subcategoryEntity->category ? new CategoryEntity($subcategoryEntity->category) : null;

        return $subcategoryEntity;
    }


    public function publicSubcategories()
    {
        $publicSubcategories = $this->client->get(sprintf('%s/public/projects/product-subcategories', $this->endpoint));

        $publicSubcategories = json_decode($publicSubcategories);

        return array_map(function ($item) {
            $subcategory = new SubcategoryEntity($item);
            $subcategory->category = $item->category ? new CategoryEntity($item->category) : null;
            return $subcategory;
        }, $publicSubcategories->data);
    }
}