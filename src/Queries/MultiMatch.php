<?php

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\Convert;
use Best\ElasticSearch\Hercules\Type\MultiMatchType;
use Best\ElasticSearch\Hercules\Type\QueryInterface;

class MultiMatch implements QueryInterface
{
    /**
     * @var string
     */
    protected $query;

    /**
     * Fields
     *
     * @var array $fields
     */
    protected $fields;

    /**
     * Tie breaker
     *
     * @var float|null $tieBreaker
     */
    protected $tieBreaker;

    /**
     * @var MultiMatchType|null
     */
    protected $type;

    /**
     * MultiMatch constructor.
     *
     * @param string $query
     */
    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     * Convert the MultiMatch into an array.
     *
     * @return array
     */
    public function toArray()
    {
        $result = [
            'query' => $this->query
        ];
        if ($this->tieBreaker !== null) {
            $result['tie_breaker'] = $this->tieBreaker;
        }
        if ($this->type !== null) {
            $result['type'] = strval($this->type);
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
     * @param float|null $tieBreaker
     * @return static
     */
    public function tieBreaker($tieBreaker)
    {
        $this->tieBreaker = Convert::toFloat($tieBreaker);
        return $this;
    }

    /**
     * Set the type.
     *
     * @param MultiMatchType|null $type
     * @return static
     */
    public function type(MultiMatchType $type)
    {
        $this->type = $type;
        return $this;
    }

}