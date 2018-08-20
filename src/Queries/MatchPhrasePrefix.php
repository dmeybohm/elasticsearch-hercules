<?php

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\Type\Query;

class MatchPhrasePrefix extends Query
{
    /**
     * @var integer|null
     */
    protected $maxExpansions = null;

    /**
     * @param int|null $maxExpansions
     * @return MatchPhrasePrefix
     */
    public function maxExpansions($maxExpansions)
    {
        $this->maxExpansions = $maxExpansions;

        return $this;
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
        return [];
    }


}