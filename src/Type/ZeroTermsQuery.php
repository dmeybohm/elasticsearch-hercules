<?php

namespace Best\ElasticSearch\Hercules\Type;

class ZeroTermsQuery
{
    /**
     * @var string
     */
    protected $option;

    /**
     * Get the all option.
     *
     * @return static
     */
    public static function all()
    {
        return new static('all');
    }

    /**
     * Get the none option.
     *
     * @return static
     */
    public static function none()
    {
		return new static('none');
    }

    /**
     * Get the option.
     *
     * @return string
     */
    public function option()
    {
        return $this->option;
    }

    /**
     * ZeroTermsQueryOption constructor.
     *
     * @param string $option
     */
    protected function __construct($option)
    {
        $this->option = $option;
    }
}