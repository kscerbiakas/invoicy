<?php

namespace Invoicy\Entity;

abstract class AbstractEntity
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var date|null
     */
    public $created_at;

    /**
     * @var date|null
     */
    public $updated_at;

    /**
     * @var date|null
     */
    public $deleted_at;
}