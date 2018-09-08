<?php

namespace Best\ElasticSearch\Hercules\Type;

use Best\ElasticSearch\Hercules\Traits\ValueConvertibleTrait;
use Best\ElasticSearch\Hercules\TypeInterfaces\ZeroTermsQueryInterface;

class ZeroTermsQuery implements ZeroTermsQueryInterface
{
    use ValueConvertibleTrait;

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