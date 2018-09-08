<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\Type;

use Best\ElasticSearch\Hercules\Traits\ValueConvertibleTrait;
use Best\ElasticSearch\Hercules\TypeInterfaces\AnalyzerInterface;
use Best\ElasticSearch\Hercules\TypeInterfaces\TypeInterface;

class Analyzer implements TypeInterface, AnalyzerInterface
{
    use ValueConvertibleTrait;

    public static function standard()
    {
        return new static('standard');
    }

    public static function custom($customName)
    {
        return new static(strval($customName));
    }
}