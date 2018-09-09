<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\TypeInterfaces\MultiMatchTypeInterface;
use Best\ElasticSearch\Hercules\TypeInterfaces\QueryInterface;

final class MultiMatch implements QueryInterface
{
    /**
     * @var string
     */
    private $query;

    /**
     * Fields
     *
     * @var array $fields
     */
    private $fields;

    /**
     * Tie breaker
     *
     * @var float|null $tieBreaker
     */
    private $tieBreaker;

    /**
     * @var MultiMatchTypeInterface|null
     */
    private $type;

    /**
     * MultiMatch constructor.
     *
     * @param string $query
     */
    public function __construct(string $query)
    {
        $this->query = $query;
    }

    /**
     * Convert the MultiMatch into an array.
     *
     * @return array
     */
    public function toValue(): array
    {
        $result = [
            'query' => $this->query
        ];
        if ($this->tieBreaker !== null) {
            $result['tie_breaker'] = $this->tieBreaker;
        }
        if ($this->type !== null) {
            $result['type'] = $this->type->toValue();
        }
        if ($this->fields !== null) {
            $result['fields'] = $this->fields;
        }
        return [
            'multi_match' => $result
        ];
    }

    /**
     * Set the fields.
     *
     * @param array $fields
     * @return static
     */
    public function fields(array $fields)
    {
        $this->fields = array_map('strval', $fields);
        return $this;
    }

    /**
     * Set the tie breaker.
     *
     * @param float $tieBreaker
     * @return static
     */
    public function tieBreaker(float $tieBreaker)
    {
        $this->tieBreaker = $tieBreaker;
        return $this;
    }

    /**
     * Set the type.
     *
     * @param MultiMatchTypeInterface $type
     * @return static
     */
    public function type(MultiMatchTypeInterface $type)
    {
        $this->type = $type;
        return $this;
    }

}