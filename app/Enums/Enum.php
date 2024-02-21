<?php
namespace App\Enums;

use ReflectionClass;

/**
 * Class Enum.
 */
abstract class Enum
{
	/**
	 * Get list of available items.
	 *
	 * @return array
	 * @throws \ReflectionException Instance of ReflectionException.
	 */
	public static function all(): array
	{
		$reflection = new ReflectionClass(static::class);

		return $reflection->getConstants();
	}

    /**
     * Get the item title.
     *
     * @param mixed $index Param.
     * @return array|null
     * @throws \ReflectionException Instance of ReflectionException.
     */
	public static function value($index)
	{
		$reflection = new ReflectionClass(static::class);
		$list = $reflection->getConstants();

		return $list[$index] ?? null;
	}

    /**
     * Get the item key.
     *
     * @param mixed $value Param.
     * @return array|null
     * @throws \ReflectionException Instance of ReflectionException.
     */
	public static function key($value)
	{
		$reflection = new ReflectionClass(static::class);
		$list = array_flip($reflection->getConstants());

		return $list[$value] ?? null;
	}

    /**
     * Return a random item in Enum.
     *
     * @return mixed
     * @throws \ReflectionException Instance of ReflectionException.
     */
	public static function random()
	{
		$reflection = new ReflectionClass(static::class);
		$options = array_flip($reflection->getConstants());

		return array_rand($options);
	}

    /**
     * Get the item title.
     *
     * @param mixed $index Param.
     * @return array|null
     * @throws \ReflectionException Instance of ReflectionException.
     */
    public static function values()
    {
        $reflection = new ReflectionClass(static::class);
        $list = $reflection->getConstants();

        return array_values( $list ) ?? [];
    }
}
