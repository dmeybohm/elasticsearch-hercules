<?php

namespace Best\ElasticSearch\Hercules\Type;

use Best\ElasticSearch\Hercules\TypeInterfaces\MinimumShouldMatchCombinationInterface;

class MinimumShouldMatchCombination implements MinimumShouldMatchCombinationInterface
{
    /**
     * @var MinimumShouldMatch
     */
    private $percentage;

    /**
     * @var MinimumShouldMatch
     */
    private $numberOfTerms;

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
    public function toValue()
    {
        return $this->numberOfTerms->toValue() . '<' .
            $this->percentage->toValue();
    }

    /**
     * MinimumShouldMatchCombination constructor.
     *
     * @param int $numberOfTerms
     * @param float $percentage
     */
    private function __construct($numberOfTerms, $percentage)
    {
        $this->numberOfTerms = MinimumShouldMatch::numberOfTerms($numberOfTerms);
        $this->percentage = MinimumShouldMatch::percentage($percentage);
    }
}