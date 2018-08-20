<?php

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\Type\Query;

class MatchAll extends Query
{
    /**
     * @param float $score
     */
    protected $score = 1.0;

    /**
     * Set the boost.
     *
     * @param float $score
     * @return static
     */
    public function boost($score)
    {
        $this->score = floatval($score);
        return $this;
    }

    /**
     * Transform the query to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $options = ($this->score !== 1.0) ? ['boost' => $this->score] : [];
        return ['match_all' => $options];
    }
}