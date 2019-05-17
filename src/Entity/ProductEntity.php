<?php

namespace Invoicy\Entity;


class ProductEntity extends AbstractEntity
{

    /**
     * @var int|null
     */
    public $category;

    /**
     * @var
     */
    public $subcategory;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $name;

    /**
     * @var date|null
     */
    public $published_at;

    /**
     * @var string|null
     */
    public $image_url;

    /**
     * @var string|null
     *
     */
    public $meta_description;

    /**
     * @var string|null
     */
    public $meta_title;

    /**
     * @var integer|null
     *
     */
    public $price;

}