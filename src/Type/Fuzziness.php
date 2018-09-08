<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\Type;

use Best\ElasticSearch\Hercules\TypeInterfaces\FuzzinessInterface;

class Fuzziness implements FuzzinessInterface
{
    /**
     * @var int|string
     */
    private $fuzziness;

    /**
     * @return static
     */
    public static function zero(): self
    {
        return new static(0);
    }

    /**
     * @return static
     */
    public static function one(): self
    {
        return new static(1);
    }

    /**
     * @return static
     */
    public static function two(): self
    {
        return new static(2);
    }

    /**
     * @return static
     */
    public static function auto(): self
    {
        return new static('AUTO');
    }

    /**
     * Convert to a string.
     *
     * @return int|string
     */
    public function toValue()
    {
        return $this->fuzziness;
    }

    /**
     * Fuzziness constructor.
     *
     * @param integer|string $fuzziness
     */
    private function __construct($fuzziness)
    {
        $this->fuzziness = $fuzziness;
    }

}