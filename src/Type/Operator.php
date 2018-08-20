<?php

namespace Best\ElasticSearch\Hercules\Type;

class Operator extends Base
{
    /**
     * Return an 'and' operator.
     *
     * @return static
     */
    public static function _and_()
    {
    	return new static('and');
    }

    /**
     * Return an 'or' operator.
     *
     * @return static
     */
    public static function _or_()
    {
        return new static('or');
    }

}