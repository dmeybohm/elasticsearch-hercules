<?php

namespace Best\ElasticSearch\Hercules\Type;

class Fuzziness implements TypeInterface
{
    protected $fuzziness;

    /**
     * @return static
     */
    public static function zero()
    {
        return new static(0);
    }

    /**
     * @return static
     */
    public static function one()
    {
        return new static(1);
    }

    /**
     * @return static
     */
    public static function two()
    {
        return new static(2);
    }

    /**
     * @return static
     */
    public static function auto()
    {
        return new static('auto');
    }

    /**
     * Fuzziness constructor.
     *
     * @param integer|string $fuzziness
     */
    protected function __construct($fuzziness)
    {
        $this->fuzziness = $fuzziness;
    }

}