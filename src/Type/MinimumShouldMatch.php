<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\Type;

use Best\ElasticSearch\Hercules\TypeInterfaces\MinimumShouldMatchCombinationInterface;
use Best\ElasticSearch\Hercules\TypeInterfaces\MinimumShouldMatchInterface;
use Best\ElasticSearch\Hercules\TypeInterfaces\MinimumShouldMatchMultipleCombinationsInterface;

class MinimumShouldMatch implements MinimumShouldMatchInterface
{
    /**
     * @var int|null
     */
    private $numberOfTerms = null;

    /**
     * @var float|null
     */
    private $percentage;

    /**
     * Create a new MinimumShouldMatch with the number of terms.
     *
     * @param integer $integer
     * @return static
     */
    public static function numberOfTerms(int $integer)
    {
        $result = new static();
        $result->numberOfTerms = $integer;
        return $result;
    }

    /**
     * Create a new MinimumShouldMatch on percentage.
     *
     * @var float $percentage A float value between 0 and 100.
     * @return static
     */
    public static function percentage(float $percentage)
    {
        $result = new static();
        $errorMessage = "Percentage must be between -100 and 100; got '{percentage}'";
        $result->percentage = $percentage;
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
    public static function combination(int $numberOfTerms, float $percentage)
    {
        return MinimumShouldMatchCombination::create($numberOfTerms, $percentage);
    }

    /**
     * Create a new MinimumShouldMatchMultipleCombination of MinimumShouldMatchCombination.
     *
     * @param MinimumShouldMatchCombinationInterface ...$combinations
     *
     * @return MinimumShouldMatchMultipleCombinationsInterface
     */
    public static function multipleCombinations(MinimumShouldMatchCombinationInterface ...$combinations)
    {
        return MinimumShouldMatchMultipleCombinations::create(...$combinations);
    }

    /**
     * Convert the MinimumShouldMatch to a string.
     *
     * @return string
     */
    public function toValue(): string
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
    private function __construct()
    {
    }
}