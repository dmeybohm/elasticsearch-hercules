<?php declare(strict_types=1);

namespace Best\ElasticSearch\Hercules\Traits;

trait ValueConvertibleTrait
{
	/**
	 * @var mixed
	 */
	private $value;

	/**
	 * Base constructor.
	 *
	 * @param mixed $value
	 */
	protected function __construct($value)
	{
		$this->value = $value;
	}

	/**
	 * Convert the object to a string.
	 *
	 * @return mixed
	 */
	public function toValue()
	{
		return $this->value;
	}
}
