<?php

namespace Best\ElasticSearch\Hercules\Test\Type;

use Best\ElasticSearch\Hercules\Type\MinimumShouldMatch;
use Best\ElasticSearch\Hercules\Type\MinimumShouldMatchCombination;
use Best\ElasticSearch\Hercules\Type\MinimumShouldMatchMultipleCombination;

class MinimumShouldMatchTest extends \PHPUnit\Framework\TestCase
{
    public function testNumberOfTerms()
    {
        $msm = MinimumShouldMatch::numberOfTerms(10);
        $this->assertSame('10', strval($msm));
    }

    public function testPercentage()
    {
        $msm = MinimumShouldMatch::percentage(100);
        $this->assertSame('100%', strval($msm));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMultipleCombinationsThrowsExceptionIfNoCombinationsSupplied()
    {
        MinimumShouldMatch::multipleCombinations();
    }

    public function testMultipleCombinations()
    {
        $this->assertInstanceOf(MinimumShouldMatchMultipleCombination::class,
            MinimumShouldMatch::multipleCombinations(
                MinimumShouldMatch::combination(1, 50)
            )
        );
    }

    public function testCombination()
    {
        $this->assertInstanceOf(MinimumShouldMatchCombination::class,
            MinimumShouldMatch::combination(1, 50)
        );
    }

    /**
     * @dataProvider provideInvalidPercentages
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidArgumentExceptionIsThrownForInvalidPercentage($value)
    {
        MinimumShouldMatch::percentage($value);
    }

    public function provideInvalidPercentages()
    {
        return [
            [-101],
            [101],
            ['hello'],
            [[]]
        ];
    }

}
