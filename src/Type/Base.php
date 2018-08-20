<?php

namespace Best\ElasticSearch\Hercules\Type;

class Base
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
		$this->type = $type;
	}

	/**
	 * Get the type.
	 *
	 * @return string
	 */
	public function type()
	{
		return $this->type;
	}
}
