<?php

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\Type\Analyzer;
use Best\ElasticSearch\Hercules\Type\Flags;
use Best\ElasticSearch\Hercules\Type\MinimumShouldMatch;
use Best\ElasticSearch\Hercules\Type\Operator;
use Best\ElasticSearch\Hercules\Type\QueryInterface;

class SimpleQueryString implements QueryInterface
{
    /**
     * @var string
     */
    protected $query;

    /**
     * @var Flags
     */
    protected $flags;

    /**
     * @var string[]
     */
    protected $fields = [];

    /**
     * @var bool|null
     */
    protected $lowercaseExpandedTerms = null;

    /**
     * @var Operator|null
     */
    protected $defaultOperator = null;

    /**
     * @var Analyzer|null
     */
    protected $analyzer;

    /**
     * Whether the terms of prefix queries will be automatically analyzed.
     *
     * @var bool|null
     */
    protected $analyzeWildcard;

    /**
     * Whether to be lenient.
     *
     * @var bool|null $lenient
     */
    protected $lenient;

    /**
     * The locale.
     *
     * @var string|null $locale
     */
    protected $locale;

    /**
     * Minimum should match.
     *
     * @var MinimumShouldMatch $minimumShouldMatch
     */
    protected $minimumShouldMatch;

    /**
     * Set the flags.
     *
     * @param Flags $flags
     * @return static
     */
    public function flags(Flags $flags)
    {
        $this->flags = $flags;
        return $this;
    }

    /**
     * SimpleQueryString constructor.
     *
     * @param string $query
     */
    public function __construct($query)
    {
       $this->query = strval($query);
    }

    /**
     * @param string[] $fields
     * @return static
     */
    public function fields(...$fields)
    {
        $this->fields = array_map('strval', $fields);
        return $this;
    }

    /**
     * @param bool|null $lowercaseExpandedTerms
     * @return static
     */
    public function lowercaseExpandedTerms($lowercaseExpandedTerms)
    {
        $this->lowercaseExpandedTerms = boolval($lowercaseExpandedTerms);
        return $this;
    }

    /**
     * Convert the SimpleQueryString query into an array.
     *
     * @return array
     */
    public function toArray()
    {
        $result = ['query' => $this->query];
        if ($this->flags !== null) {
            $result['flags'] = strval($this->flags);
        }
        if ($this->fields) {
            $result['fields'] = implode(',', $this->fields);
        }
        if ($this->lowercaseExpandedTerms !== null) {
            $result['lowercase_expanded_terms'] = $this->lowercaseExpandedTerms;
        }
        if ($this->defaultOperator !== null) {
            $result['default_operator'] = $this->defaultOperator;
        }
        if ($this->analyzer !== null) {
            $result['analyzer'] = strval($this->analyzer);
        }
        if ($this->minimumShouldMatch !== null) {
            $result['minimum_should_match'] = strval($this->minimumShouldMatch);
        }
        if ($this->locale !== null) {
            $result['locale'] = $this->locale;
        }
        if ($this->analyzeWildcard !== null) {
            $result['analyze_wildcard'] = $this->analyzeWildcard;
        }
        return ['simple_query_string' => $result];
    }

    /**
     * @param Operator|null $defaultOperator
     * @return SimpleQueryString
     */
    public function defaultOperator(Operator $defaultOperator)
    {
        $this->defaultOperator = $defaultOperator;
        return $this;
    }

    /**
     * Whether the terms of prefix queries will be automatically analyzed.
     *
     * @param bool|null $analyzeWildcard
     * @return static
     */
    public function analyzeWildcard($analyzeWildcard)
    {
        $this->analyzeWildcard = boolval($analyzeWildcard);
        return $this;
    }

    /**
     * @param MinimumShouldMatch $minimumShouldMatch
     * @return static
     */
    public function minimumShouldMatch(MinimumShouldMatch $minimumShouldMatch)
    {
        $this->minimumShouldMatch = $minimumShouldMatch;
        return $this;
    }
}