<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\TypeInterfaces\QueryInterface;

final class MatchAll implements QueryInterface
{
    /**
     * @param float $score
     */
    private $score = 1.0;

    /**
     * Set the boost.
     *
     * @param float $score
     * @return static
     */
    public function boost(float $score)
    {
        $this->score = $score;
        return $this;
    }

    /**
     * Transform the query to an array.
     *
     * @return array
     */
    public function toValue(): array
    {
        $options = ($this->score !== 1.0) ? ['boost' => $this->score] : [];
        return ['match_all' => $options];
    }
}
