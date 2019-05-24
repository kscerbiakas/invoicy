<?php

namespace Invoicy\Entity;


class CategoryEntity extends AbstractEntity
{
    /**
     * @var string|null
     */
    public $description;

    /**
     * @var string|null
     */
    public $meta_description;

    /**
     * @var string|null
     */
    public $meta_title;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var Carbon\Carbon
     */
    public $published_at;

    /**
     * @var array SubcategoryEntity
     */
    public $subcategories;
}