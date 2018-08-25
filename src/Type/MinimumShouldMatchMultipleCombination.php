<?php

namespace Best\ElasticSearch\Hercules\Type;

class MinimumShouldMatchMultipleCombination extends MinimumShouldMatch
{
    /**
     * @var MinimumShouldMatchCombination[]
     */
    protected $combinations;

    public static function create(MinimumShouldMatchCombination ...$combinations)
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
    public function __toString()
    {
        $result = "";
        $last = count($this->combinations) - 1;
        foreach ($this->combinations as $i => $combination) {
            $result .= strval($combination);
            if ($i < $last) {
                $result .= ' ';
            }
        }
        return $result;
    }

    protected function __construct(MinimumShouldMatchCombination ...$combinations)
    {
        $this->combinations = $combinations;
    }
}