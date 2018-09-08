<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\TypeInterfaces\QueryInterface;
use Best\ElasticSearch\Hercules\TypeInterfaces\AnalyzerInterface;

final class MatchPhrase implements QueryInterface
{
    /**
     * @var AnalyzerInterface
     */
    private $analyzer;

    public function __construct()
    {
        // TODO
    }

    /**
     * @return array
     */
    public function toValue()
    {
        // TODO: Change the autogenerated stub
        return [];
    }

    /**
     *
     * @param AnalyzerInterface $analyzer
     * @return MatchPhrase
     */
    public function analyzer(AnalyzerInterface $analyzer): self
    {
        $this->analyzer = $analyzer;
        return $this;
    }
}