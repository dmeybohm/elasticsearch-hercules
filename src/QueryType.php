<?php

namespace Best\ElasticSearch\Hercules;

class QueryType
{
    const TERM = 'term';
    const TERMS = 'terms';
    const RANGE = 'range';
    const MATCH = 'match';
    const MATCH_ALL = 'match_all';
    const MATCH_NONE = 'match_none';
    const MATCH_PHRASE = 'match_phrase';
    const MULTI_MATCH = 'multi_match';
}