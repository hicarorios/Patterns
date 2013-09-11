<?php

namespace Model;

abstract class AbstractEntity
{
    public function __set($field, $value)
    {
        if (!property_exists($this, $field)) {
            throw new InvalidArgumentException(
                "Setting the field '$field' is not valid for this entity.");
        }

        $mutator = "set" . ucfirst(strtolower($field));
        method_exists($this, $mutator)
            && is_callable(array($this, $mutator)) ? $this->$mutator($value) : $this->$field = $value;

        return $this;
    }

    public function __get($field)
    {
        if (!property_exists($this, $field)) {
            throw new InvalidArgumentException(
                "Getting the field '$field' is not valid for this entity.");
        }

        $accessor = "get" . ucfirst(strtolower($field));
        return method_exists($this, $accessor) &&
        is_callable(array($this, $accessor))
            ? $this->$accessor() : $this->$field;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}