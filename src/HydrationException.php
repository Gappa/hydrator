<?php declare(strict_types = 1);

namespace Nettrine\DoctrineHydration;

use Exception;

class HydrationException extends Exception
{

	/**
	 * @param mixed $object
	 * @throws HydrationException
	 */
	public static function checkObject($object): void
	{
		if (!is_string($object) && !is_object($object)) {
			throw new self(sprintf('Given object must be string or object, %s given', gettype($object)));
		}
	}

	/**
	 * @throws HydrationException
	 */
	public static function valueNotExists(string $name): void
	{
		throw new self(sprintf('Value for item %s not exists.', $name));
	}

	/**
	 * @throws HydrationException
	 */
	public static function cannotInjectParameter(string $name): void
	{
		throw new self(sprintf('Cannot inject value to parameter %s', $name));
	}

	/**
	 * @throws HydrationException
	 */
	public static function cannotGetParameter(string $name): void
	{
		throw new self(sprintf('Cannot get value from parameter %s', $name));
	}

}
