<?php

namespace Best\ElasticSearch\Hercules\Type;

use Best\ElasticSearch\Hercules\Queries;

abstract class Query
{
    /**
     * Serialize the query to an array.
     *
     * @return array
     */
    abstract public function toArray();

    /**
     * Build a match query.
     *
     * @param string $fieldToMatch
     * @param string $matchPhrase

     * @return Queries\Match
     */
    public static function match($fieldToMatch, $matchPhrase)
    {
        return new Queries\Match($fieldToMatch, $matchPhrase);
    }

    /**
     * Build a match all query.
     *
     * @return Queries\MatchAll
     */
    public static function matchAll()
    {
        return new Queries\MatchAll();
    }

    /**
     * Build a match none query.
     *
     * @return Queries\MatchNone
     */
    public static function matchNone()
    {
        return new Queries\MatchNone();
    }

    public static function matchPhrase()
    {
        // @todo
        return new Queries\MatchPhrase();
    }

    public static function matchPhrasePrefix()
    {
        // @todo
        return new Queries\MatchPhrasePrefix();
    }

    /**
     * @param string $fieldToMatch
     * @param string $exactTerm
     * @return Queries\Term
     */
    public static function term($fieldToMatch, $exactTerm)
    {
        return new Queries\Term($fieldToMatch, $exactTerm);
    }

}