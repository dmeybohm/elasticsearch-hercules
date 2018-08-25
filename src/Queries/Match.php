<?php

namespace Best\ElasticSearch\Hercules\Queries;

use Best\ElasticSearch\Hercules\Type\QueryInterface;
use Best\ElasticSearch\Hercules\Type\Fuzziness;
use Best\ElasticSearch\Hercules\Type\Operator;
use Best\ElasticSearch\Hercules\Type\ZeroTermsQuery;

class Match implements QueryInterface
{
    /**
     * @type Fuzziness|null
     */
    protected $fuzziness;

    /**
     * @var Operator|null
     */
    protected $operator;

    /**
     * @var ZeroTermsQuery|null
     */
    protected $zeroTermsQuery;

    /**
     * @var integer|float|null
     */
    protected $cutoffFrequency;

    /**
     * @var boolean|null
     */
    protected $autoGenerateSynonymsPhraseQuery = null;

    /**
     * @var string
     */
    protected $fieldToMatch;

    /**
     * @var string
     */
    protected $matchPhrase;

    /**
     * Match constructor.
     *
     * @param string $fieldToMatch
     * @param string $matchPhrase
     */
    public function __construct($fieldToMatch, $matchPhrase)
    {
        $this->fieldToMatch = strval($fieldToMatch);
        $this->matchPhrase = strval($matchPhrase);
    }

    /**
     * Set the fuzziness
     *
     * @param Fuzziness $fuzziness
     * @return $this
     */
    public function fuzziness(Fuzziness $fuzziness)
    {
        $this->fuzziness = $fuzziness;
        return $this;
    }

    /**
     * Set the operator.
     *
     * @param Operator $operator
     * @return $this
     */
    public function operator(Operator $operator)
    {
        $this->operator = $operator;
        return $this;
    }

    /**
     * Set the zero terms query option.
     *
     * @param ZeroTermsQuery $zeroTermsQuery
     * @return $this
     */
    public function zeroTermsQuery(ZeroTermsQuery $zeroTermsQuery)
    {
        $this->zeroTermsQuery = $zeroTermsQuery;
        return $this;
    }

    /**
     * @param float|int $cutoffFrequency
     * @return Match
     */
    public function cutoffFrequency($cutoffFrequency)
    {
        $this->cutoffFrequency = floatval($cutoffFrequency);
        return $this;
    }

    /**
     * @param bool $autoGenerateSynonymsPhraseQuery
     * @return Match
     */
    public function autoGenerateSynonymsPhraseQuery($autoGenerateSynonymsPhraseQuery)
    {
        $this->autoGenerateSynonymsPhraseQuery = boolval($autoGenerateSynonymsPhraseQuery);
        return $this;
    }

    /**
     * Turn the Match query into an array.
     *
     * @return array
     */
    public function toArray()
    {
        if ($this->autoGenerateSynonymsPhraseQuery !== null ||
            $this->cutoffFrequency !== null ||
            $this->zeroTermsQuery !== null ||
            $this->operator !== null
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
            if ($this->zeroTermsQuery !== null) {
                $fields['zero_terms_query'] = strval($this->zeroTermsQuery);
            }
            if ($this->operator !== null) {
                $fields['operator'] = strval($this->operator);
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