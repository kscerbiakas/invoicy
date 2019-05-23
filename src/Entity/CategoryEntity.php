<?php

namespace Invoicy\Entity;


class CategoryEntity extends AbstractEntity
{
    public $description;

    public $meta_description;

    public $meta_title;

    public $title;

    public $published_at;

    /**
     * @var array SubcategoryEntity
     */
    public $subcategories;
}