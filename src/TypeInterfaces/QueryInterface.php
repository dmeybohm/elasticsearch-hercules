<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\TypeInterfaces;

interface QueryInterface extends TypeInterface
{
    /**
     * Return the query represented as an array.
     *
     * @return array
     */
    public function toValue();
}