<?php

namespace Best\Test\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\Queries\SimpleQueryString;
use Best\ElasticSearch\Hercules\Type\MinimumShouldMatch;
use Best\ElasticSearch\Hercules\Type\MinimumShouldMatchCombination;
use Best\ElasticSearch\Hercules\Type\MinimumShouldMatchMultipleCombination;

class SimpleQueryStringTest extends \PHPUnit\Framework\TestCase
{
    public function testMinimumShouldMatch()
    {
        $query = new SimpleQueryString('querytest');
        $query->minimumShouldMatch(MinimumShouldMatch::multipleCombinations(
            MinimumShouldMatchCombination::create(1, 2),
            MinimumShouldMatchCombination::create(4, 50)
        ));
        $expected = [
            'simple_query_string' => [
                'query' => 'querytest',
                'minimum_should_match' => '1<2% 4<50%'
            ]
        ];
        $this->assertEquals($expected, $query->toArray());
    }

    public function testToArray()
    {
        $query = new SimpleQueryString('querytest');
        $this->assertEquals(['simple_query_string' => ['query' => 'querytest']], $query->toArray());
    }

    public function testConstruct()
    {
        $this->assertNotNull(new SimpleQueryString('test'));
    }
}
