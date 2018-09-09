<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules;

use Best\ElasticSearch\Hercules\Traits\BooleanQueryTrait;

final class QueryBuilder implements \JsonSerializable
{
    use BooleanQueryTrait;

	/**
	 * Create a new builder.
	 *
	 * @return static
	 */
	public static function create(): self
	{
		return new static();
	}

    /**
     * Builder constructor.
     */
    private function __construct()
    {
    }

	/**
	 * Build the JSON
	 *
	 * @return array
	 */
	public function build(): array
	{
		$andQueryCount = count($this->andQueries);
		$orQueryCount = count($this->orQueries);
		$filterCount = count($this->filters);
		$exclusionCount = count($this->notQueries);

        if ($andQueryCount === 1 && $orQueryCount === 0 && $filterCount === 0 && $exclusionCount === 0) {
            return ['query' => $this->andQueries[0]->toValue()];

        }
        elseif ($andQueryCount === 0 && $orQueryCount === 1 && $filterCount === 0 && $exclusionCount === 0) {
            return ['query' => $this->orQueries[0]->toValue()];

        }
        elseif (
            $filterCount === 1 &&
            $andQueryCount === 0 &&
            $orQueryCount == 0 &&
            $exclusionCount === 0
        ) {
            // @todo
            return [];
        }
        else {
            return ['query' => $this->booleanQueryToArray()];
        }
	}

	/**
	 * @return array
	 */
	public function jsonSerialize()
	{
		return $this->build();
	}

}