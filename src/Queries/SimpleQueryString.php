<?php declare(strict_types=1);

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
     * Quote field suffix.
     *
     * @var string|null
     */
    private $quoteFieldSuffix;

    /**
     * Set the flags.
     *
     * @param FlagsInterface|null $flags
     * @return static
     */
    public function flags(?FlagsInterface $flags)
    {
        $this->flags = $flags;
        return $this;
    }

    /**
     * SimpleQueryString constructor.
     *
     * @param string $query
     */
    public function __construct(string $query)
    {
       $this->query = $query;
    }

    /**
     * @param string[] $fields
     * @return static
     */
    public function fields(string ...$fields): self
    {
        $this->fields = array_map('strval', $fields);
        return $this;
    }

    /**
     * @param bool $lowercaseExpandedTerms
     * @return static
     */
    public function lowercaseExpandedTerms(bool $lowercaseExpandedTerms): self
    {
        $this->lowercaseExpandedTerms = $lowercaseExpandedTerms;
        return $this;
    }

    /**
     * Convert the SimpleQueryString query into an array.
     *
     * @return array
     */
    public function toValue(): array
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
        if ($this->quoteFieldSuffix !== null) {
            $result['quote_field_suffix'] = $this->quoteFieldSuffix;
        }
        return ['simple_query_string' => $result];
    }

    /**
     * Set the default operator for the query.
     *
     * @param OperatorInterface $defaultOperator
     * @return static
     */
    public function defaultOperator(OperatorInterface $defaultOperator): self
    {
        $this->defaultOperator = $defaultOperator;
        return $this;
    }

    /**
     * Whether the terms of prefix queries will be automatically analyzed.
     *
     * @param bool $analyzeWildcard
     * @return static
     */
    public function analyzeWildcard(bool $analyzeWildcard): self
    {
        $this->analyzeWildcard = $analyzeWildcard;
        return $this;
    }

    /**
     * Set the minimumShouldMatch.
     *
     * @param MinimumShouldMatchInterface $minimumShouldMatch
     * @return static
     */
    public function minimumShouldMatch(MinimumShouldMatchInterface $minimumShouldMatch): self
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
    public function locale(string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * Set the analyzer.
     *
     * @param AnalyzerInterface $analyzer
     * @return static
     */
    public function analyzer(AnalyzerInterface $analyzer): self
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
    public function lenient(bool $lenient): self
    {
        $this->lenient = $lenient;
        return $this;
    }

    /**
     * Set the quote field suffix.
     *
     * @param string $quoteFieldSuffix
     * @return static
     */
    public function quoteFieldSuffix(string $quoteFieldSuffix): self
    {
        $this->quoteFieldSuffix = $quoteFieldSuffix;
        return $this;
    }

}