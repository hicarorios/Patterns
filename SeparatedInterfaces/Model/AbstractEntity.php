<?php

namespace SeparatedInterfaces\Model;

class AbstractEntity
{
    protected $id;

    //set values for protected/private fields via the corresponding mutators
    public function __set($field, $value)
    {
        $this->checkField($field);
        $mutator = "set" . ucfirst(strtolower($field));
        method_exists($this, $mutator) &&
        is_callable(array($this, $mutator))
            ? $this->$mutator($value)
            : $this->$field = $value;
        return $this;
    }

    // get values from protected/private fields via the corresponding accessors
    public function __get($field)
    {
        $this->checkField($field);
        $accessor = "get" . ucfirst(strtolower($field));
        return method_exists($this, $accessor) &&
        is_callable(array($this, $accessor))
            ? $this->$accessor()
            : $this->$field;
    }

    protected function checkField($field)
    {
        if (!property_exists($this, $field)) {
            throw new \InvalidArgumentException("Setting or getting the field '$field'j is not valid for this entity.");
        }
    }

    // sanitize strings assigned to the fields of the entity
    protected function sanitizeString($value, $min = 2, $max = null)
    {
        if (!is_string($value)
        || strlen($value) < (integer) $min
        || ($max) ? strlen($value) > (integer) $max : false) {
            throw new \InvalidArgumentException("The value of the field accessed must be a valid string.");
        }
        return htmlspecialchars(trim($value), ENT_QUOTES);
    }

    // handle IDs
    public function setId($id)
    {
        if ($this->id !== null) {
            throw new \BadMethodCallException("The ID for this entity has been set already.");
        }
        if (!is_int($id) || $id < 1) {
            throw new \InvalidArgumentException("The ID of this entity is invalid.");
        }
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }
}