<?php

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\TypeInterfaces\QueryInterface;

final class MatchPhrasePrefix implements QueryInterface
{
    /**
     * @var integer|null
     */
    private $maxExpansions = null;

    /**
     * @param int|null $maxExpansions
     * @return static
     */
    public function maxExpansions($maxExpansions)
    {
        $this->maxExpansions = $maxExpansions;
        return $this;
    }

    public function toValue()
    {
        // TODO: Implement toArray() method.
        return [];
    }


}