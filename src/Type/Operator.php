<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\Type;

use Best\ElasticSearch\Hercules\Traits\ValueConvertibleTrait;
use Best\ElasticSearch\Hercules\TypeInterfaces\OperatorInterface;

class Operator implements OperatorInterface
{
    use ValueConvertibleTrait;

    /**
     * Return an 'and' operator.
     *
     * @return static
     */
    public static function logicalAnd()
    {
    	return new static('and');
    }

    /**
     * Return an 'or' operator.
     *
     * @return static
     */
    public static function logicalOr()
    {
        return new static('or');
    }

}