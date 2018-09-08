<?php

namespace Best\ElasticSearch\Hercules\Type;

use Best\ElasticSearch\Hercules\Traits\ValueConvertibleTrait;
use Best\ElasticSearch\Hercules\TypeInterfaces\MultiMatchTypeInterface;

class MultiMatchType implements MultiMatchTypeInterface
{
    use ValueConvertibleTrait;

    /**
     * Return a best_fields multi match type
     *
     * @return static
     */
    public static function bestFields()
    {
        return new static('best_fields');
    }

    /**
     * Return a most_fields multi match type
     *
     * @return static
     */
    public static function mostFields()
    {
        return new static('most_fields');
    }

    /**
     * Return a cross_fields multi match type
     *
     * @return static
     */
    public static function crossFields()
    {
        return new static('cross_fields');
    }

    /**
     * Return a phrase multi match type
     *
     * @return static
     */
    public static function phrase()
    {
        return new static('phrase');
    }

    /**
     * Return a phrase_prefix multi match type
     *
     * @return static
     */
    public static function phrasePrefix()
    {
        return new static('phrase_prefix');
    }

}