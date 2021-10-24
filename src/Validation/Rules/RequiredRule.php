<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 9/25/2021
 * Time: 6:58 PM
 */

namespace PhpMvc\Validation\Rules;

use PhpMvc\Validation\Rules\Contract\Rule;

class RequiredRule implements Rule {
    public function apply($field, $value, $data): bool
    {
        return !empty($value);
    }

    public function __toString(): string
    {
        return '%s is required and cannot be empty';
    }
}