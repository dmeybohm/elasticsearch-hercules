<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\Type;

use Best\ElasticSearch\Hercules\TypeInterfaces\FlagsInterface;
use Best\ElasticSearch\Hercules\TypeInterfaces\TypeInterface;

class Flags implements TypeInterface, FlagsInterface
{
    /**
     * @var boolean[]
     */
    private $flags;

    /**
     * Create a new Flags object.
     *
     * @return static
     */
    public static function create(): self
    {
        return new static();
    }

    /**
     * Add an "all" to the flags.
     *
     * @return static
     */
    public function addAll(): self
    {
        $this->add("ALL");
        return $this;
    }

    public function addOr(): self
    {
        $this->add("OR");
        return $this;
    }

    public function addAnd(): self
    {
        $this->add("AND");
        return $this;
    }

    public function addNot(): self
    {
        $this->add("NOT");
        return $this;
    }

    public function addPrefix(): self
    {
        $this->add("PREFIX");
        return $this;
    }

    public function addPhrase(): self
    {
        $this->add("PHRASE");
        return $this;
    }

    public function addPrecedence(): self
    {
        $this->add("PRECEDENCE");
        return $this;
    }

    public function addEscape(): self
    {
        $this->add("ESCAPE");
        return $this;
    }

    public function addWhitespace(): self
    {
        $this->add("WHITESPACE");
        return $this;
    }

    public function addFuzzy(): self
    {
        $this->add("FUZZY");
        return $this;
    }

    public function addNear(): self
    {
        $this->add("NEAR");
        return $this;
    }

    public function addSlop(): self
    {
        $this->add("SLOP");
        return $this;
    }

    public function toValue(): string
    {
        return implode("|", array_keys($this->flags));
    }

    /**
     * Add the string to the array.
     *
     * @param $string
     */
    private function add($string): void
    {
        $this->flags[$string] = true;
    }
}