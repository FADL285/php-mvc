<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 9/25/2021
 * Time: 3:26 PM
 */

namespace PhpMvc\Validation;

class ErrorBag {

    protected array $errors;

    public function __get(string $key)
    {
        if (property_exists($this, $key)) {
             return $this->$key;
        }
        return  null;
    }

    public function add($field, $message)
    {
        $this->errors[$field][] = $message;
    }
}