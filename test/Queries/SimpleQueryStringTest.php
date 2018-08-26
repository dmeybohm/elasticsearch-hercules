<?php

namespace Best\Test\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\Queries\SimpleQueryString;
use Best\ElasticSearch\Hercules\Type\Flags;
use Best\ElasticSearch\Hercules\Type\MinimumShouldMatch;
use Best\ElasticSearch\Hercules\Type\MinimumShouldMatchCombination;
use Best\ElasticSearch\Hercules\Type\Operator;

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


    public function testAllOptions()
    {
        $query = new SimpleQueryString('querytest');
        $result = $query
            ->flags(Flags::create()->addAll()->addAnd())
            ->minimumShouldMatch(MinimumShouldMatch::percentage(50))
            ->fields('hello', 'goodbye')
            ->lowercaseExpandedTerms(true)
            ->locale('utf-8')
            ->defaultOperator(Operator::logicalAnd())
            ->analyzeWildcard(true)
            ->toArray();

        $expected = [
            'simple_query_string' => [
                'query' => 'querytest',
                'flags' => 'ALL|AND',
                'fields' => ['hello', 'goodbye'],
                'lowercase_expanded_terms' => true,
                'default_operator' => 'and',
                'analyze_wildcard' => true,
                'locale' => 'utf-8',
                'minimum_should_match' => '50%'
            ]
        ];
        $this->assertEquals($expected, $result);
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
