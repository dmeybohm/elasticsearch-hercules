<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\Queries\Compound;

use Best\ElasticSearch\Hercules\TypeInterfaces\QueryInterface;

final class CompoundConstantScore implements QueryInterface
{
    /**
     * @var float|null
     */
    private $boost;

    /**
     * @var QueryInterface
     */
    private $query;

    /**
     * CompoundConstantScore constructor.
     *
     * @param \Best\ElasticSearch\Hercules\TypeInterfaces\QueryInterface $query
     */
    public function __construct(QueryInterface $query)
    {
        $this->query = $query;
    }

    /**
     * Convert the query to an array.
     *
     * @return array
     */
    public function toValue(): array
    {
        $result = ['constant_score' => ['filter' => $this->query->toValue()]];
        if ($this->boost !== null) {
            $result['constant_score']['boost'] = $this->boost;
        }
        return $result;
    }

    /**
     * Set the boost.
     *
     * @param float $boost
     * @return static
     */
    public function boost(float $boost): self
    {
        $this->boost = $boost;
        return $this;
    }

}