<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 9/21/2021
 * Time: 12:45 AM
 */

namespace PhpMvc\Support;

use ArrayAccess;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class Arr {

    public static function only(array $array, $key): array
    {
        return array_intersect_key($array, array_flip((array)$key));
    }

    public static function accessible($value): bool
    {
        return is_array($value) || $value instanceof ArrayAccess;
    }

    public static function exists(array $array, $key): bool
    {
        if ($array instanceof ArrayAccess) {
            return $array->offsetExists($key);
        }

        return array_key_exists($key, $array);
    }

    public static function has(array $array, $keys): bool
    {
        if (is_null($keys)) {
            return false;
        }
        $keys = (array)$keys;

        if ($keys === []) {
            return false;
        }

        foreach ($keys as $key) {
            $subArray = $array;

            if (static::exists($array, $key)) {
                continue;
            } else {
                foreach (explode('.', $key) as $segment) {
                    if (static::accessible($subArray) && static::exists($subArray, $segment)) {
                        $subArray = $subArray[$segment];
                    } else {
                        return false;
                    }

                }
            }
        }

        return true;
    }

    public static function first(array $array, callable $callback = null, $default = null)
    {
        if (is_null($callback)) {
            if (empty($array)) {
                return value($default);
            }

            foreach ($array as $item) {
                return $item;
            }
        }

        foreach ($array as $key => $value) {
            if (is_callable($callback)) {
                return call_user_func($callback, $value, $key);
            }
        }

        return value($default);
    }

    public static function last(array $array, callable $callback = null, $default = null)
    {
        if (is_null($callback)) {
            return empty($array) ? value($default) : end($array);
        }

        return static::first(array_reverse($array, true), $callback, $default);
    }

    public static function flatten(array $array): array
    {
        $result = [];
        $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($array));
        foreach ($it as $v) {
            $result[] = $v;
        }

        return $result;
    }

    public static function set(array &$array, $key, $value)
    {
        if (is_null($key)) {
            array_push($array, $value);
        }

        $keys = explode('.', $key);
        foreach ($keys as $segment) {
            $array = &$array[$segment];
        }

        $array = $value;
    }

    public static function unset(array &$array, $key)
    {
        static::set($array, $key, null);
    }

    public static function get(array $array, $key, $default = null)
    {
        if (!static::accessible($array)) {
            return value($default);
        }

        if (is_null($key)) {
            return $array;
        }

        if (static::has($array, $key)) {
            if (!str_contains($key, '.')) {
                return $array[$key];
            } else {
                foreach (explode('.', $key) as $segment) {
                    $array = $array[$segment];
                }

                return $array;
            }
        }

        return value($default);
    }

    public static function forget(array &$array, $keys)
    {
        $original = &$array;
        $keys = (array)$keys;

        if (!count($keys)) {
            return;
        }

        foreach ($keys as $key) {
            if (static::exists($array, $key)) {
                unset($array[$key]);

                continue;
            }

            $parts = explode('.', $key);
            // clean up before each pass
            $array = &$original;
            while (count($parts) > 1) {
                $part = array_shift($parts);
                if (isset($array[$part]) && is_array($array[$part])) {
                    $array = &$array[$part];
                } else {
                    continue;
                }
            }
            unset($array[array_shift($parts)]);
        }

    }

    public static function except(array $array, $keys): array
    {
        static::forget($array, $keys);

        return $array;
    }

}