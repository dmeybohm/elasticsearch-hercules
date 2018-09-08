<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules;

use Best\ElasticSearch\Hercules\Queries;

/**
 * This class is not meant to be extended.
 *
 * It is just a convenience class container for static factory methods for creating queries.
 */
abstract class Query
{
    /**
     * Build a match query.
     *
     * @param string $fieldToMatch
     * @param string $matchPhrase
     *
     * @return \Best\ElasticSearch\Hercules\Queries\Match
     */
    public static function match($fieldToMatch, $matchPhrase): Queries\Match
    {
        return new Queries\Match($fieldToMatch, $matchPhrase);
    }

    /**
     * Build a match all query.
     *
     * @return \Best\ElasticSearch\Hercules\Queries\MatchAll
     */
    public static function matchAll(): Queries\MatchAll
    {
        return new Queries\MatchAll();
    }

    /**
     * Build a match none query.
     *
     * @return \Best\ElasticSearch\Hercules\Queries\MatchNone
     */
    public static function matchNone(): Queries\MatchNone
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
    public static function multiMatch($query): Queries\MultiMatch
    {
        return new Queries\MultiMatch($query);
    }

    public static function matchPhrase(): Queries\MatchPhrase
    {
        // @todo
        return new Queries\MatchPhrase();
    }

    public static function matchPhrasePrefix(): Queries\MatchPhrasePrefix
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
    public static function simpleQueryString($query): Queries\SimpleQueryString
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
    public static function term($fieldToMatch, $exactTerm): Queries\Term
    {
        return new Queries\Term($fieldToMatch, $exactTerm);
    }
}