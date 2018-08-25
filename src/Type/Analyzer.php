<?php

namespace Best\ElasticSearch\Hercules\Type;

use Best\ElasticSearch\Hercules\Traits\StringableTrait;

class Analyzer implements TypeInterface
{
    use StringableTrait;

    public static function standard()
    {
        return new static('standard');
    }

    public static function custom($customName)
    {
        return new static($customName);
    }
}