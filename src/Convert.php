<?php

namespace Best\ElasticSearch\Hercules;

/**
 * Utility class to convert values and throw exceptions.
 */
final class Convert
{
    /**
     * Convert a value to a float.
     *
     * @param mixed $value
     * @return float
     */
    public static function toFloat($value)
    {
        $value = filter_var($value, FILTER_VALIDATE_FLOAT);
        if ($value === false) {
            throw new \InvalidArgumentException("Error converting value to float: '$value'");
        }
        return floatval($value);
    }

    /**
     * Convert a value to an integer.
     *
     * @param mixed $value
     * @return int
     */
    public static function toInteger($value)
    {
        $value = filter_var($value, FILTER_VALIDATE_INT);
        if ($value === false) {
            throw new \InvalidArgumentException("Error converting value to integer: '$value'");
        }
        return $value;
    }

    /**
     * Convert a value to a string.
     *
     * @param mixed $value
     * @return string
     */
    public static function toString($value)
    {
        if (is_array($value)) {
            throw new \InvalidArgumentException("Cannot convert array to string");
        }
        return strval($value);
    }
}