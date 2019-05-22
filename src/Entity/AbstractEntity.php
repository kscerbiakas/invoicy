<?php

namespace Invoicy\Entity;

use Carbon\Carbon;

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


    /**
     * @param \stdClass|array|null $parameters
     */
    public function __construct($parameters = null)
    {
        if (!$parameters) {
            return;
        }

        if ($parameters instanceof \stdClass) {
            $parameters = get_object_vars($parameters);
        }

        $this->build($parameters);
    }

    /**
     * @param array $parameters
     */
    public function build(array $parameters)
    {
        foreach ($parameters as $property => $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }


    /**
     * @return array
     */
    public function toArray()
    {
        $settings = [];
        $called = get_called_class();

        $reflection = new \ReflectionClass($called);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) {
            $prop = $property->getName();
            if (isset($this->$prop) && $property->class == $called) {
                $settings[self::convertToSnakeCase($prop)] = $this->$prop;
            }
        }

        return $settings;
    }

    /**
     * @param string|null $date string
     *
     * @return Carbon\Carbon
     */
    protected static function convertDateTime($date)
    {

        if (!$date) {
            return;
        }

        return Carbon::parse($date);
    }

    /**
     * @param string $str Snake case string
     *
     * @return string Camel case string
     */
    protected static function convertToCamelCase($str)
    {
        $callback = function ($match) {
            return strtoupper($match[2]);
        };

        return lcfirst(preg_replace_callback('/(^|_)([a-z])/', $callback, $str));
    }

    /**
     * @param $str Camel case string
     *
     * @return string Snake case string
     */
    protected static function convertToSnakeCase($str)
    {
        return strtolower(implode('_', preg_split('/(?=[A-Z])/', $str)));
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = static::convertDateTime($createdAt);
    }

    /**
     * @param $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = static::convertDateTime($updatedAt);
    }

    /**
     * @param $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deleted_at = static::convertDateTime($deletedAt);
    }
}