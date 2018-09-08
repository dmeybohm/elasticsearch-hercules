<?php

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\TypeInterfaces\MinimumShouldMatchInterface;
use Best\ElasticSearch\Hercules\TypeInterfaces\OperatorInterface;
use Best\ElasticSearch\Hercules\TypeInterfaces\AnalyzerInterface;
use Best\ElasticSearch\Hercules\TypeInterfaces\QueryInterface;
use Best\ElasticSearch\Hercules\TypeInterfaces\FlagsInterface;

final class SimpleQueryString implements QueryInterface
{
    /**
     * @var string
     */
    private $query;

    /**
     * @var \Best\ElasticSearch\Hercules\TypeInterfaces\FlagsInterface
     */
    private $flags;

    /**
     * @var string[]
     */
    private $fields = [];

    /**
     * @var bool|null
     */
    private $lowercaseExpandedTerms = null;

    /**
     * @var OperatorInterface|null
     */
    private $defaultOperator = null;

    /**
     * @var AnalyzerInterface|null
     */
    private $analyzer;

    /**
     * Whether the terms of prefix queries will be automatically analyzed.
     *
     * @var bool|null
     */
    private $analyzeWildcard;

    /**
     * Whether to be lenient.
     *
     * @var bool|null
     */
    private $lenient;

    /**
     * The locale.
     *
     * @var string|null
     */
    private $locale;

    /**
     * Minimum should match.
     *
     * @var MinimumShouldMatchInterface $minimumShouldMatch
     */
    private $minimumShouldMatch;

    /**
     * Set the flags.
     *
     * @param FlagsInterface $flags
     * @return static
     */
    public function flags(FlagsInterface $flags)
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
    public function toValue()
    {
        $result = ['query' => $this->query];
        if ($this->flags !== null) {
            $result['flags'] = $this->flags->toValue();
        }
        if ($this->fields) {
            $result['fields'] = $this->fields;
        }
        if ($this->lowercaseExpandedTerms !== null) {
            $result['lowercase_expanded_terms'] = $this->lowercaseExpandedTerms;
        }
        if ($this->defaultOperator !== null) {
            $result['default_operator'] = $this->defaultOperator->toValue();
        }
        if ($this->analyzer !== null) {
            $result['analyzer'] = $this->analyzer->toValue();
        }
        if ($this->minimumShouldMatch !== null) {
            $result['minimum_should_match'] = $this->minimumShouldMatch->toValue();
        }
        if ($this->locale !== null) {
            $result['locale'] = $this->locale;
        }
        if ($this->analyzeWildcard !== null) {
            $result['analyze_wildcard'] = $this->analyzeWildcard;
        }
        if ($this->lenient !== null) {
            $result['lenient'] = $this->lenient;
        }
        return ['simple_query_string' => $result];
    }

    /**
     * @param OperatorInterface|null $defaultOperator
     * @return SimpleQueryString
     */
    public function defaultOperator(OperatorInterface $defaultOperator)
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
     * Set the minimumShouldMatch.
     *
     * @param MinimumShouldMatchInterface $minimumShouldMatch
     * @return static
     */
    public function minimumShouldMatch(MinimumShouldMatchInterface $minimumShouldMatch)
    {
        $this->minimumShouldMatch = $minimumShouldMatch;
        return $this;
    }

    /**
     * Set the locale.
     *
     * @param string|null $locale
     * @return static
     */
    public function locale($locale)
    {
        $this->locale = strval($locale);
        return $this;
    }

    /**
     * Set the analyzer.
     *
     * @param AnalyzerInterface|null $analyzer
     * @return static
     */
    public function analyzer(AnalyzerInterface $analyzer)
    {
        $this->analyzer = $analyzer;
        return $this;
    }

    /**
     * Set the lenient.
     *
     * @param bool|null $lenient
     * @return static
     */
    public function lenient($lenient)
    {
        $this->lenient = $lenient === null ? null : boolval($lenient);
        return $this;
    }

}