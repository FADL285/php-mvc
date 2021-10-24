<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 9/25/2021
 * Time: 3:29 PM
 */

namespace PhpMvc\Validation\Rules\Contract;

interface Rule {

    public function apply($field, $value, $data);

    public function __toString(): string;
}