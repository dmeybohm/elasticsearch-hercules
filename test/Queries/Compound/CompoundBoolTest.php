<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\Test\Queries\Compound;

use Best\ElasticSearch\Hercules\Queries\Compound\CompoundBool;
use Best\ElasticSearch\Hercules\Query;
use PHPUnit\Framework\TestCase;

class CompoundBoolTest extends TestCase
{
    public function testToValue()
    {
        $compoundBool = new CompoundBool();
        $compoundBool
            ->andQuery(Query::term('title', 'Infinity War'))
            ->notQuery(Query::term('director', 'Joss Whedon'))
            ->orQuery(Query::term('director', 'Russo Brothers'));

        $this->assertEquals([
            'bool' => [
                'must' => [
                    [
                        'term' => ['title' => 'Infinity War'],
                    ]
                ],
                'should' => [
                    [
                        'term' => ['director' => 'Russo Brothers']
                    ]
                ],
                'must_not' => [
                    [
                        'term' => ['director' => 'Joss Whedon']
                    ]
                ]
            ]
        ], $compoundBool->toValue());
    }
}
