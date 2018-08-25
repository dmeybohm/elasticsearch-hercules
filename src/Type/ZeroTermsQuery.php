<?php

namespace Best\ElasticSearch\Hercules\Type;

use Best\ElasticSearch\Hercules\Traits\StringableTrait;

class ZeroTermsQuery implements TypeInterface
{
    use StringableTrait;

    /**
     * Get the all option.
     *
     * @return static
     */
    public static function all()
    {
        return new static('all');
    }

    /**
     * Get the none option.
     *
     * @return static
     */
    public static function none()
    {
		return new static('none');
    }
}