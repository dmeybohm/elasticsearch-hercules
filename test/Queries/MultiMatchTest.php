<?php

namespace Best\ElasticSearch\Hercules\Test\Queries;

use Best\ElasticSearch\Hercules\Queries\MultiMatch;
use Best\ElasticSearch\Hercules\Type\MultiMatchType;

class MultiMatchTest extends \PHPUnit\Framework\TestCase
{
    public function testToArray()
    {
        $multiMatch = new MultiMatch('welcome');
        $result = $multiMatch->tieBreaker(5.0)
            ->fields(['cheese', 'blarg'])
            ->type(MultiMatchType::bestFields())
            ->toValue();

        $this->assertEquals([
            'multi_match' => [
                'query' => 'welcome',
                'fields' => ['cheese', 'blarg'],
                'type' => 'best_fields',
                'tie_breaker' => 5.0
            ],
        ], $result);
    }
}
