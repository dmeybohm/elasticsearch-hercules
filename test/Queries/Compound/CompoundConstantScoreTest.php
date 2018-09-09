<?php

namespace Best\ElasticSearch\Hercules\Test\Queries\Compound;

use Best\ElasticSearch\Hercules\Queries\Compound\CompoundConstantScore;
use Best\ElasticSearch\Hercules\Query;

class CompoundConstantScoreTest extends \PHPUnit\Framework\TestCase
{
    public function testToValue()
    {
        $term = Query::term('foo', 'bar');
        $compoundScore = new CompoundConstantScore($term);
        $compoundScore->boost(1.2);
        $this->assertEquals([
            'constant_score' => [
                'filter' => ['term' => ['foo' => 'bar']],
                'boost' => 1.2
            ]
        ], $compoundScore->toValue());
    }
}
