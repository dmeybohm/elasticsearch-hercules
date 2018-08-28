<?php

namespace Best\ElasticSearch\Hercules\Type;

use Best\ElasticSearch\Hercules\Convert;

class MinimumShouldMatch implements TypeInterface
{
    /**
     * @var int|null
     */
    protected $numberOfTerms = null;

    /**
     * @var float|null
     */
    protected $percentage;

    /**
     * Create a new MinimumShouldMatch with the number of terms.
     *
     * @param integer $integer
     * @return static
     */
    public static function numberOfTerms($integer)
    {
        $result = new static();
        $result->numberOfTerms = Convert::toInteger($integer);
        return $result;
    }

    /**
     * Create a new MinimumShouldMatch on percentage.
     *
     * @var float $percentage A float value between 0 and 100.
     * @return static
     */
    public static function percentage($percentage)
    {
        $result = new static();
        $errorMessage = "Percentage must be between -100 and 100; got '{percentage}'";
        $result->percentage = Convert::toFloat($percentage);
        if ($result->percentage < -100.0 || $result->percentage > 100.0) {
            throw new \InvalidArgumentException($errorMessage);
        }
        return $result;
    }

    /**
     * Create a new MinimumShouldMatch with the number of terms and percentage.
     *
     * @param int $numberOfTerms
     * @param float $percentage
     *
     * @return MinimumShouldMatchCombination
     */
    public static function combination($numberOfTerms, $percentage)
    {
        return MinimumShouldMatchCombination::create($numberOfTerms, $percentage);
    }

    /**
     * Create a new MinimumShouldMatchMultipleCombination of MinimumShouldMatchCombination.
     *
     * @param MinimumShouldMatchCombination ...$combinations
     *
     * @return MinimumShouldMatchMultipleCombinations
     */
    public static function multipleCombinations(MinimumShouldMatchCombination ...$combinations)
    {
        return MinimumShouldMatchMultipleCombinations::create(...$combinations);
    }

    /**
     * Convert the MinimumShouldMatch to a string.
     *
     * @return string
     */
    public function __toString()
    {
        if ($this->percentage !== null) {
            return strval($this->percentage) . '%';

        } elseif ($this->numberOfTerms !== null) {
            return strval($this->numberOfTerms);

        } else {
            throw new \RuntimeException("Invalid type of MinimumShouldMatch");
        }
    }

    /**
     * MinimumShouldMatch constructor.
     */
    protected function __construct()
    {
    }
}