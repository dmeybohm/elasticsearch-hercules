<?php

namespace Best\ElasticSearch\Hercules\Type;

use Best\ElasticSearch\Hercules\Queries;

abstract class Query
{
    /**
     * Build a match query.
     *
     * @param string $fieldToMatch
     * @param string $matchPhrase

     * @return \Best\ElasticSearch\Hercules\Queries\Match
     */
    public static function match($fieldToMatch, $matchPhrase)
    {
        return new Queries\Match($fieldToMatch, $matchPhrase);
    }

    /**
     * Build a match all query.
     *
     * @return \Best\ElasticSearch\Hercules\Queries\MatchAll
     */
    public static function matchAll()
    {
        return new Queries\MatchAll();
    }

    /**
     * Build a match none query.
     *
     * @return \Best\ElasticSearch\Hercules\Queries\MatchNone
     */
    public static function matchNone()
    {
        return new Queries\MatchNone();
    }

    /**
     * Build a new multimatch query.
     *
     * @param string $query
     *
     * @return \Best\ElasticSearch\Hercules\Queries\MultiMatch
     */
    public static function multiMatch($query)
    {
        return new Queries\MultiMatch($query);
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
     * Build a new simple query string query.
     *
     * @param string $query
     *
     * @return \Best\ElasticSearch\Hercules\Queries\SimpleQueryString
     */
    public static function simpleQueryString($query)
    {
        return new Queries\SimpleQueryString($query);
    }

    /**
     * Build a new term query.
     *
     * @param string $fieldToMatch
     * @param string $exactTerm
     *
     * @return \Best\ElasticSearch\Hercules\Queries\Term
     */
    public static function term($fieldToMatch, $exactTerm)
    {
        return new Queries\Term($fieldToMatch, $exactTerm);
    }
}