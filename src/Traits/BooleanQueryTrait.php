<?php

namespace Best\ElasticSearch\Hercules\Traits;

use Best\ElasticSearch\Hercules\Filter;
use Best\ElasticSearch\Hercules\TypeInterfaces\QueryInterface;

trait BooleanQueryTrait
{
    /**
     * @var QueryInterface[]
     */
    private $andQueries = [];

    /**
     * @var QueryInterface[]
     */
    private $orQueries = [];

    /**
     * @var QueryInterface[]
     */
    private $notQueries = [];

    /**
     * @var Filter[]
     */
    private $filters = [];

    /**
     * Add a query to the builder.
     *
     * @param QueryInterface ...$queries
     * @return static
     */
    public function query(QueryInterface ...$queries): self
    {
        return $this->andQuery(...$queries);
    }

    /**
     * Add an "or" query.
     *
     * @param QueryInterface ...$queries
     * @return static
     */
    public function orQuery(QueryInterface ...$queries): self
    {
        $this->orQueries = array_merge($this->orQueries, $queries);
        return $this;
    }

    /**
     * Add an "and" query.
     *
     * @param QueryInterface ...$queries
     * @return static
     */
    public function andQuery(QueryInterface ...$queries): self
    {
        $this->andQueries = array_merge($this->andQueries, $queries);
        return $this;
    }

    /**
     * Add a "not" query.
     *
     * @param QueryInterface ...$queries
     * @return static
     */
    public function notQuery(QueryInterface ...$queries): self
    {
        $this->notQueries = array_merge($this->notQueries, $queries);
        return $this;
    }

    /**
     * Translate the boolean query to an array.
     *
     * @return array
     */
    private function booleanQueryToArray(): array
    {
        $result = ['bool' => []];

        if ($this->andQueries) {
            $result['bool']['must'] = $this->serializeQueries($this->andQueries);
        }
        if ($this->orQueries) {
            $result['bool']['should'] = $this->serializeQueries($this->orQueries);
        }
        if ($this->notQueries) {
            $result['bool']['must_not'] = $this->serializeQueries($this->notQueries);
        }
        if ($this->filters) {
            $result['bool']['filter'] = $this->serializeQueries($this->filters);
        }

        return $result;
    }

    /**
     * Serialize the queries to an array.
     *
     * @param QueryInterface[] $queries
     * @return array
     */
    private function serializeQueries(array $queries): array
    {
        $result = [];
        foreach ($queries as $query) {
            $result[] = $query->toValue();
        }
        return $result;
    }
}