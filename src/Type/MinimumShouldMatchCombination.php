<?php

namespace Best\ElasticSearch\Hercules\Type;

class MinimumShouldMatchCombination extends MinimumShouldMatch
{
    /**
     * Create a new MinimumShouldMatchCombination
     *
     * @param int $numberOfTerms
     * @param float $percentage
     *
     * @return static
     */
    public static function create($numberOfTerms, $percentage)
    {
        return new static($numberOfTerms, $percentage);
    }

    /**
     * Convert the MinimumShouldMatchCombination to a string.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf("%d<%d%%", $this->numberOfTerms, $this->percentage);
    }

    /**
     * MinimumShouldMatchCombination constructor.
     *
     * @param int $numberOfTerms
     * @param float $percentage
     */
    protected function __construct($numberOfTerms, $percentage)
    {
        $this->numberOfTerms = $numberOfTerms;
        $this->percentage = $percentage;
    }
}