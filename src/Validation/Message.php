<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 9/25/2021
 * Time: 3:26 PM
 */

namespace PhpMvc\Validation;

class Message {

    public static function generate($rule, $field): array|string
    {
        return str_replace('%s', $field, $rule);
    }
}