<?php

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\Type\Query;

class Term extends Query
{
    /**
     * @var string
     */
    protected $fieldToMatch;

    /**
     * @var string
     */
    protected $exactTerm;

    /**
     * @var float|null
     */
    protected $boost;

    /**
     * Term constructor.
     *
     * @param string $fieldToMatch
     * @param string $exactTerm
     */
    public function __construct($fieldToMatch, $exactTerm)
    {
        $this->fieldToMatch = strval($fieldToMatch);
        $this->exactTerm = strval($exactTerm);
    }

    /**
     * Set the boost.
     *
     * @param float|null $boost
     * @return Term
     */
    public function boost($boost)
    {
        $this->boost = $boost !== null ? floatval($boost) : $boost;
        return $this;
    }

    /**
     * Get the Term query as an array.
     *
     * @return array
     */
    public function toArray()
    {
        if ($this->boost !== null) {
            return [
                'term' => [
                    $this->fieldToMatch => [
                        'boost' => $this->boost,
                        'value' => $this->exactTerm
                    ]
                ]
            ];
        } else {
            return [
                'term' => [
                    $this->fieldToMatch => $this->exactTerm
                ]
            ];
        }
    }


}