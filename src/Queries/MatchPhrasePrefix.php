<?php

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\Type\QueryInterface;

class MatchPhrasePrefix implements QueryInterface
{
    /**
     * @var integer|null
     */
    protected $maxExpansions = null;

    /**
     * @param int|null $maxExpansions
     * @return static
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