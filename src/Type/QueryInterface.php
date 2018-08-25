<?php

namespace Best\ElasticSearch\Hercules\Type;

interface QueryInterface
{
    /**
     * Return the query represented as an array.
     *
     * @return array
     */
    public function toArray();
}