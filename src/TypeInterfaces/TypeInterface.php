<?php

namespace Best\ElasticSearch\Hercules\TypeInterfaces;

interface TypeInterface
{
    /**
     * Convert the object to a string in JSON format.
     *
     * @return mixed
     */
    public function toValue();
}