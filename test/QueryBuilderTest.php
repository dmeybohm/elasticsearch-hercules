<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\Test;

use Best\ElasticSearch\Hercules\QueryBuilder;
use Best\ElasticSearch\Hercules\Query;
use Best\ElasticSearch\Hercules\Type\Fuzziness;
use Best\ElasticSearch\Hercules\Type\Operator;
use Best\ElasticSearch\Hercules\Type\ZeroTermsQuery;

class QueryBuilderTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $instance = QueryBuilder::create();
        $this->assertInstanceOf(QueryBuilder::class, $instance);
    }

    public function testBuildMatchAll()
    {
        $builder = QueryBuilder::create();
        $builder->query(Query::matchAll());
        $this->assertEquals(['query' => ['match_all' => []]], $builder->build());

        $builder2 = QueryBuilder::create();
        $builder2->query(Query::matchAll()->boost(1.001));
        $this->assertEquals(['query' => ['match_all' => ['boost' => 1.001]]], $builder2->build());
    }

    public function testBuildMatchNone()
    {
        $builder = QueryBuilder::create();
        $builder->query(Query::matchNone());
        $this->assertEquals(['query' => ['match_none' => []]], $builder->build());
    }

    public function testMatch()
    {
        $builder = QueryBuilder::create();
        $builder->query(Query::match("field", "match phrase"));
        $this->assertEquals(['query' => ['match' => ['field' => 'match phrase']]], $builder->build());

        $result = QueryBuilder::create()
            ->query(
                Query::match('field2', 'match phrase2')
                    ->cutoffFrequency(1.5)
                    ->autoGenerateSynonymsPhraseQuery(false)
                    ->fuzziness(Fuzziness::auto())
                    ->operator(Operator::logicalOr())
                    ->zeroTermsQuery(ZeroTermsQuery::all())
            )
            ->build();

        $expected = [
            'query' => [
                'match' => [
                    'field2' => [
                        'query' => 'match phrase2',
                        'cutoff_frequency' => 1.5,
                        'auto_generate_synonyms_phrase_query' => false,
                        'zero_terms_query' => 'all',
                        'operator' => 'or',
                        'fuzziness' => 'AUTO'
                    ]
                ]
            ]
        ];
        $this->assertEquals($expected, $result);
    }

    public function testCombiningQueries()
    {
        $builder = QueryBuilder::create()
            ->query(Query::match('hello', 'goodbye'))
            ->query(Query::term('field1', 'value1'))
            ->query(Query::term('field2', 'value2'));

        $this->assertEquals([
            'query' => [
                'bool' => [
                    'must' => [
                        ['match' => ['hello' => 'goodbye']],
                        ['term' => ['field1' => 'value1']],
                        ['term' => ['field2' => 'value2']],
                    ]
                ]
            ]
        ], $builder->build());

        $result = QueryBuilder::create()
           ->andQuery(
               Query::match('hello', 'goodbye'),
               Query::matchAll()
            )
            ->orQuery(
                Query::match('foo', 'bar')
            )
            ->orQuery(
                Query::term('term1', 'termValue')
            )
            ->build();

        $expected = [
            'query' => [
                'bool' => [
                    'must' => [
                        ['match' => ['hello' => 'goodbye']],
                        ['match_all' => []],
                    ],
                    'should' => [
                        ['match' => ['foo' => 'bar']],
                        ['term' => ['term1' => 'termValue']],
                    ]
                ]
            ]
        ];
        $this->assertEquals($expected, $result);
    }

    public function testBuilderCanBeSerializedToJson()
    {
        $builder = QueryBuilder::create()
            ->andQuery(
                Query::match('hello', 'goodbye'),
                Query::matchAll()
            )
            ->orQuery(
                Query::match('foo', 'bar')
            )
            ->orQuery(
                Query::term('term1', 'termValue')
            );

        $expected = json_encode([
            'query' => [
                'bool' => [
                    'must' => [
                        ['match' => ['hello' => 'goodbye']],
                        ['match_all' => []],
                    ],
                    'should' => [
                        ['match' => ['foo' => 'bar']],
                        ['term' => ['term1' => 'termValue']],
                    ]
                ]
            ]
        ]);
        $this->assertEquals($expected, json_encode($builder));
    }

    public function testSimpleQuery()
    {
        $result = QueryBuilder::create()
            ->query(Query::simpleQueryString('hello query string'))
            ->build();
        $this->assertEquals(['query' => ['simple_query_string' => ['query' => 'hello query string']]], $result);
    }

    public function testNotQuery()
    {
        $builder = QueryBuilder::create()
            ->andQuery(
                Query::match('hello', 'goodbye'),
                Query::matchAll()
            )
            ->orQuery(
                Query::match('foo', 'bar')
            )
            ->orQuery(
                Query::term('term1', 'termValue')
            )
            ->notQuery(
                Query::term('notField1', 'notValue1')
            )
            ->notQuery(
                Query::term('notField2', 'notValue2')
            );

        $expected = json_encode([
            'query' => [
                'bool' => [
                    'must' => [
                        ['match' => ['hello' => 'goodbye']],
                        ['match_all' => []],
                    ],
                    'should' => [
                        ['match' => ['foo' => 'bar']],
                        ['term' => ['term1' => 'termValue']],
                    ],
                    'must_not' => [
                        ['term' => ['notField1' => 'notValue1']],
                        ['term' => ['notField2' => 'notValue2']],
                    ]
                ]
            ]
        ]);
        $this->assertEquals($expected, json_encode($builder));
    }


}