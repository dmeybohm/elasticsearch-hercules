<?php

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\TypeInterfaces\QueryInterface;

final class MatchNone implements QueryInterface
{
    /**
     * Turn the query into an array.
     *
     * @return array
     */
    public function toValue()
    {
        return ['match_none' => []];
    }


}