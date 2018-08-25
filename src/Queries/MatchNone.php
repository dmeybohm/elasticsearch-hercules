<?php

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\Type\QueryInterface;

class MatchNone implements QueryInterface
{
    /**
     * Turn the query into an array.
     *
     * @return array
     */
    public function toArray()
    {
        return ['match_none' => []];
    }


}