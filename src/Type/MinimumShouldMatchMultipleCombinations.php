<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\Type;

use Best\ElasticSearch\Hercules\TypeInterfaces\MinimumShouldMatchCombinationInterface;
use Best\ElasticSearch\Hercules\TypeInterfaces\MinimumShouldMatchMultipleCombinationsInterface;

class MinimumShouldMatchMultipleCombinations implements MinimumShouldMatchMultipleCombinationsInterface
{
    /**
     * @var \Best\ElasticSearch\Hercules\TypeInterfaces\MinimumShouldMatchCombinationInterface[]
     */
    private $combinations;

    /**
     * @param \Best\ElasticSearch\Hercules\TypeInterfaces\MinimumShouldMatchCombinationInterface ...$combinations
     * @return \Best\ElasticSearch\Hercules\Type\MinimumShouldMatchMultipleCombinations
     */
    public static function create(MinimumShouldMatchCombinationInterface ...$combinations)
    {
        if (count($combinations) === 0) {
            throw new \InvalidArgumentException("Must supply at least one combination");
        }
        return new static(...$combinations);
    }

    /**
     * Convert the MinimumShouldMatchMultipleCombination to a string.
     *
     * @return string
     */
    public function toValue()
    {
        $result = "";
        $last = count($this->combinations) - 1;
        foreach ($this->combinations as $i => $combination) {
            $result .= $combination->toValue();
            if ($i < $last) {
                $result .= ' ';
            }
        }
        return $result;
    }

    private function __construct(MinimumShouldMatchCombinationInterface ...$combinations)
    {
        $this->combinations = $combinations;
    }
}