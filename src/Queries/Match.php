<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\TypeInterfaces\OperatorInterface;
use Best\ElasticSearch\Hercules\TypeInterfaces\FuzzinessInterface;
use Best\ElasticSearch\Hercules\TypeInterfaces\QueryInterface;
use Best\ElasticSearch\Hercules\TypeInterfaces\ZeroTermsQueryInterface;

final class Match implements QueryInterface
{
    /**
     * @var FuzzinessInterface|null
     */
    private $fuzziness;

    /**
     * @var OperatorInterface|null
     */
    private $operator;

    /**
     * @var ZeroTermsQueryInterface|null
     */
    private $zeroTermsQuery;

    /**
     * @var integer|float|null
     */
    private $cutoffFrequency;

    /**
     * @var boolean|null
     */
    private $autoGenerateSynonymsPhraseQuery = null;

    /**
     * @var string
     */
    private $fieldToMatch;

    /**
     * @var string
     */
    private $matchPhrase;

    /**
     * Match constructor.
     *
     * @param string $fieldToMatch
     * @param string $matchPhrase
     */
    public function __construct(string $fieldToMatch, string $matchPhrase)
    {
        $this->fieldToMatch = strval($fieldToMatch);
        $this->matchPhrase = strval($matchPhrase);
    }

    /**
     * Set the fuzziness
     *
     * @param \Best\ElasticSearch\Hercules\TypeInterfaces\FuzzinessInterface $fuzziness
     * @return static
     */
    public function fuzziness(FuzzinessInterface $fuzziness): self
    {
        $this->fuzziness = $fuzziness;
        return $this;
    }

    /**
     * Set the operator.
     *
     * @param OperatorInterface $operator
     * @return $this
     */
    public function operator(OperatorInterface $operator): self
    {
        $this->operator = $operator;
        return $this;
    }

    /**
     * Set the zero terms query option.
     *
     * @param ZeroTermsQueryInterface $zeroTermsQuery
     * @return $this
     */
    public function zeroTermsQuery(ZeroTermsQueryInterface $zeroTermsQuery): self
    {
        $this->zeroTermsQuery = $zeroTermsQuery;
        return $this;
    }

    /**
     * @param float|int $cutoffFrequency
     * @return Match
     */
    public function cutoffFrequency(float $cutoffFrequency): self
    {
        $this->cutoffFrequency = $cutoffFrequency;
        return $this;
    }

    /**
     * @param bool $autoGenerateSynonymsPhraseQuery
     * @return Match
     */
    public function autoGenerateSynonymsPhraseQuery(bool $autoGenerateSynonymsPhraseQuery): self
    {
        $this->autoGenerateSynonymsPhraseQuery = boolval($autoGenerateSynonymsPhraseQuery);
        return $this;
    }

    /**
     * Turn the Match query into an array.
     *
     * @return array
     */
    public function toValue(): array
    {
        if ($this->autoGenerateSynonymsPhraseQuery !== null ||
            $this->cutoffFrequency !== null ||
            $this->zeroTermsQuery !== null ||
            $this->operator !== null ||
            $this->fuzziness !== null
        ) {
            $fields = [
                'query' => $this->matchPhrase
            ];
            if ($this->autoGenerateSynonymsPhraseQuery !== null) {
                $fields['auto_generate_synonyms_phrase_query'] = $this->autoGenerateSynonymsPhraseQuery;
            }
            if ($this->cutoffFrequency !== null) {
                $fields['cutoff_frequency'] = $this->cutoffFrequency;
            }
            if ($this->fuzziness !== null) {
                $fields['fuzziness'] = $this->fuzziness->toValue();
            }
            if ($this->zeroTermsQuery !== null) {
                $fields['zero_terms_query'] = $this->zeroTermsQuery->toValue();
            }
            if ($this->operator !== null) {
                $fields['operator'] = $this->operator->toValue();
            }

            return [
                'match' => [
                    $this->fieldToMatch => $fields
                ]
            ];

        } else {
            return [
                'match' => [
                    $this->fieldToMatch => $this->matchPhrase
                ]
            ];
        }
    }


}
