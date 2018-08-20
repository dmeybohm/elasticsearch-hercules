<?php

namespace Best\ElasticSearch\Hercules;

use Best\ElasticSearch\Hercules\Type\Query;

class Builder implements \JsonSerializable
{
	/**
	 * @var Query[]
	 */
	protected $andQueries = [];

	/**
	 * @var Query[]
	 */
	protected $orQueries = [];

	/**
	 * @var Query[]
	 */
	protected $notQueries = [];

	/**
	 * @var Filter[]
	 */
	protected $filters = [];

	/**
	 * Create a new builder.
	 *
	 * @return static
	 */
	public static function create()
	{
		return new static();
	}

	/**
	 * Add a query to the builder.
	 *
	 * @param Query ...$queries
	 * @return static
	 */
	public function query(Query ...$queries)
	{
		return $this->andQuery(...$queries);
	}

	/**
	 * Add an "or" query.
	 *
	 * @param Query ...$queries
	 * @return static
	 */
	public function orQuery(Query ...$queries)
	{
		$this->orQueries = array_merge($this->orQueries, $queries);
		return $this;
	}

	/**
	 * Add an "and" query.
	 *
	 * @param Query ...$queries
	 * @return static
	 */
	public function andQuery(Query ...$queries)
	{
		$this->andQueries = array_merge($this->andQueries, $queries);
		return $this;
	}

	/**
	 * Add a "not" query.
	 *
	 * @param Query ...$queries
	 * @return static
	 */
	public function notQuery(Query ...$queries)
	{
		$this->notQueries = array_merge($this->notQueries, $queries);
		return $this;
	}

	/**
	 * Build the JSON
	 *
	 * @return array
	 */
	public function build()
	{
		$andQueryCount = count($this->andQueries);
		$orQueryCount = count($this->orQueries);
		$filterCount = count($this->filters);
		$exclusionCount = count($this->notQueries);

		if ($andQueryCount === 1 && $orQueryCount === 0 && $filterCount === 0 && $exclusionCount === 0) {
			return ['query' => $this->andQueries[0]->toArray()];

		} elseif ($andQueryCount === 0 && $orQueryCount === 1 && $filterCount === 0 && $exclusionCount === 0) {
			return ['query' => $this->orQueries[0]->toArray()];

		} elseif (
			$filterCount === 1 &&
			$andQueryCount === 0 &&
			$orQueryCount == 0 &&
			$exclusionCount === 0 &&
			$orQueryCount == 0
		) {
			// @todo
			return [];

		} else {
			$result = ['query' => ['bool' => []]];
			if ($this->andQueries) {
				$result['query']['bool']['must'] = $this->serializeQueries($this->andQueries);
			}
			if ($this->orQueries) {
				$result['query']['bool']['should'] = $this->serializeQueries($this->orQueries);
			}
			if ($this->notQueries) {
				$result['query']['bool']['must_not'] = $this->serializeQueries($this->notQueries);
			}
			return $result;
		}
	}

	/**
	 * @return array
	 */
	public function jsonSerialize()
	{
		return $this->build();
	}

	/**
	 * Serialize the queries to an array.
	 *
	 * @param Query[] $queries
	 * @return array
	 */
	private function serializeQueries(array $queries)
	{
		$result = [];
		foreach ($queries as $query) {
			$result[] = $query->toArray();
		}
		return $result;
	}
}