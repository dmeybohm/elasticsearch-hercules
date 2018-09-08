<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\TypeInterfaces;

interface TypeInterface
{
    /**
     * Convert the object to a value.
     *
     * @return mixed
     */
    public function toValue();
}