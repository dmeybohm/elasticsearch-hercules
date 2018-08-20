<?php

namespace Best\ElasticSearch\Hercules\Type;

class Match extends Base
{
	/**
	 * Get the 'all' match type.
	 *
	 * @return static
	 */
	public static function all()
	{
		return new static('all');
	}

	/**
	 * Get the 'none' match type.
	 *
	 * @return Match
	 */
	public static function none()
	{
		return new static('none');
	}
}