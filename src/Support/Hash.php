<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 9/24/2021
 * Time: 10:52 PM
 */

namespace PhpMvc\Support;

class Hash {

    public static function password($value): string
    {
        return password_hash($value, PASSWORD_BCRYPT);
    }

    public static function verify($value, $hashed_value): bool
    {
        return password_verify($value, $hashed_value);
    }

    public static function make($value): string
    {
        return sha1($value, time());
    }
}