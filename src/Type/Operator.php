<?php

namespace Best\ElasticSearch\Hercules\Type;

use Best\ElasticSearch\Hercules\Traits\StringableTrait;

class Operator implements TypeInterface
{
    use StringableTrait;

    /**
     * Return an 'and' operator.
     *
     * @return static
     */
    public static function logicalAnd()
    {
    	return new static('and');
    }

    /**
     * Return an 'or' operator.
     *
     * @return static
     */
    public static function logicalOr()
    {
        return new static('or');
    }

}