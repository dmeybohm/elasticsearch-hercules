<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\TypeInterfaces\QueryInterface;

final class MatchAll implements QueryInterface
{
    /**
     * @param float $score
     */
    private $boost = 1.0;

    /**
     * Set the boost.
     *
     * @param float $boost
     * @return static
     */
    public function boost(float $boost)
    {
        $this->boost = $boost;
        return $this;
    }

    /**
     * Transform the query to an array.
     *
     * @return array
     */
    public function toValue(): array
    {
        $options = ($this->boost !== 1.0) ? ['boost' => $this->boost] : [];
        return ['match_all' => $options];
    }
}
