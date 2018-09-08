<?php

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
    public static function create()
    {
        return new static();
    }

    /**
     * Add an "all" to the flags.
     *
     * @return static
     */
    public function addAll()
    {
        $this->add("ALL");
        return $this;
    }

    public function addOr()
    {
        $this->add("OR");
        return $this;
    }

    public function addAnd()
    {
        $this->add("AND");
        return $this;
    }

    public function addNot()
    {
        $this->add("NOT");
        return $this;
    }

    public function addPrefix()
    {
        $this->add("PREFIX");
        return $this;
    }

    public function addPhrase()
    {
        $this->add("PHRASE");
        return $this;
    }

    public function addPrecedence()
    {
        $this->add("PRECEDENCE");
        return $this;
    }

    public function addEscape()
    {
        $this->add("ESCAPE");
        return $this;
    }

    public function addWhitespace()
    {
        $this->add("WHITESPACE");
        return $this;
    }

    public function addFuzzy()
    {
        $this->add("FUZZY");
        return $this;
    }

    public function addNear()
    {
        $this->add("NEAR");
        return $this;
    }

    public function addSlop()
    {
        $this->add("SLOP");
        return $this;
    }

    public function toValue()
    {
        return implode("|", array_keys($this->flags));
    }

    /**
     * Add the string to the array.
     *
     * @param $string
     */
    private function add($string)
    {
        $this->flags[$string] = true;
    }
}