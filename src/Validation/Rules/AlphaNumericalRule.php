<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 9/25/2021
 * Time: 8:28 PM
 */

namespace PhpMvc\Validation\Rules;

use PhpMvc\Validation\Rules\Contract\Rule;

class AlphaNumericalRule implements Rule {
    public function apply($field, $value, $data): bool|int
    {
        return preg_match('/^[a-zA-Z0-9]+/', $value);
    }

    public function __toString(): string
    {
        return '%s must be characters and numbers only.';
    }
}