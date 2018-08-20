<?php

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\Type\Query;

class MatchNone extends Query
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