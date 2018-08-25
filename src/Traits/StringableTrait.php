<?php

namespace Best\ElasticSearch\Hercules\Traits;

trait StringableTrait
{
	/**
	 * @var string
	 */
	private $type;

	/**
	 * Base constructor.
	 *
	 * @param string $type
	 */
	protected function __construct($type)
	{
		$this->type = strval($type);
	}

	/**
	 * Convert the object to a string.
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->type;
	}
}
