<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\Queries\Compound;

use Best\ElasticSearch\Hercules\Traits\BooleanQueryTrait;
use Best\ElasticSearch\Hercules\TypeInterfaces\QueryInterface;

final class CompoundBool implements QueryInterface
{
    use BooleanQueryTrait;

    /**
     * Translate the boolean query to an array.
     *
     * @return array
     */
    public function toValue(): array
    {
        return $this->booleanQueryToArray();
    }
}