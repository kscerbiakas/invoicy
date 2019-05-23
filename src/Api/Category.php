<?php


namespace Invoicy\Api;

use Invoicy\Entity\CategoryEntity;
use Invoicy\Entity\SubcategoryEntity;

class Category extends AbstractApi
{
    public function publicCategories()
    {
        $publicCategories = $this->client->get(sprintf('%s/public/projects/product-categories', $this->endpoint));

        $publicCategories = json_decode($publicCategories);

        return array_map(function ($category) {
            $publicCategory = new CategoryEntity($category);
            if (!empty($category->subcategories)) {
                $publicCategory->subcategories = array_map(function ($subcategory) {
                    return new SubcategoryEntity($subcategory);
                }, $category->subcategories);

            }
            return $publicCategory;
        }, $publicCategories->data);
    }

    public function publicCategoryById($id)
    {
        $publicCategory = $this->client->get(sprintf('%s/public/projects/product-categories/%s', $this->endpoint, $id));

        $publicCategory = json_decode($publicCategory);

        return new CategoryEntity($publicCategory->data);
    }
}