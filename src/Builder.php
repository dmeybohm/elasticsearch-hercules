<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules;

use Best\ElasticSearch\Hercules\TypeInterfaces\QueryInterface;

final class Builder implements \JsonSerializable
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
	 * @param QueryInterface ...$queries
	 * @return static
	 */
	public function query(QueryInterface ...$queries)
	{
		return $this->andQuery(...$queries);
	}

	/**
	 * Add an "or" query.
	 *
	 * @param QueryInterface ...$queries
	 * @return static
	 */
	public function orQuery(QueryInterface ...$queries)
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
	public function andQuery(QueryInterface ...$queries)
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
	public function notQuery(QueryInterface ...$queries)
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
			return ['query' => $this->andQueries[0]->toValue()];

		} elseif ($andQueryCount === 0 && $orQueryCount === 1 && $filterCount === 0 && $exclusionCount === 0) {
			return ['query' => $this->orQueries[0]->toValue()];

		} elseif (
			$filterCount === 1 &&
			$andQueryCount === 0 &&
			$orQueryCount == 0 &&
			$exclusionCount === 0
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
	 * @param QueryInterface[] $queries
	 * @return array
	 */
	private function serializeQueries(array $queries)
	{
		$result = [];
		foreach ($queries as $query) {
			$result[] = $query->toValue();
		}
		return $result;
	}
}