<?php

namespace Best\ElasticSearch\Hercules\Type;

class MinimumShouldMatchCombination extends MinimumShouldMatch
{
    /**
     * @var MinimumShouldMatch
     */
    protected $percentageInstance;

    /**
     * @var MinimumShouldMatch
     */
    protected $numberOfTermsInstance;

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
        return strval($this->numberOfTermsInstance) . '<' .
            strval($this->percentageInstance);
    }

    /**
     * MinimumShouldMatchCombination constructor.
     *
     * @param int $numberOfTerms
     * @param float $percentage
     */
    protected function __construct($numberOfTerms, $percentage)
    {
        $this->numberOfTermsInstance = MinimumShouldMatch::numberOfTerms($numberOfTerms);
        $this->percentageInstance = MinimumShouldMatch::percentage($percentage);
    }
}