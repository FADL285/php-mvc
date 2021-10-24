<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 9/25/2021
 * Time: 2:59 PM
 */

namespace PhpMvc\Validation;

use PhpMvc\Validation\Rules\AlphaNumericalRule;
use PhpMvc\Validation\Rules\RequiredRule;

class Validator {

    protected array $data = [];
    protected array $rules = [];
    protected array $aliases = [];
    protected ErrorBag $errorBag;
    protected array $ruleMap = [
        'required' => RequiredRule::class,
        'alnum' => AlphaNumericalRule::class
    ];

    /**
     * @param array $data
     */
    public function make(array $data)
    {
        $this->data = $data;
        $this->errorBag = new ErrorBag;
        $this->validate();
    }

    protected function validate()
    {
        foreach ($this->rules as $field => $rules) {
            foreach ($rules as $rule) {
                if (is_string($rule)){
                    $rule = new $this->ruleMap[$rule];
                }
                if (!$rule->apply($field, $this->getFieldValue($field), $this->data)) {
                    $this->errorBag->add($field, message::generate($rule, $this->alias($field)));
                }
            }
        }
    }

    public function getFieldValue($field)
    {
        return $this->data[$field] ?? null;
    }

    /**
     * @param array $rules
     */
    public function setRules(array $rules): void
    {
        $this->rules = $rules;
    }

    public function passes(): bool
    {
        return empty($this->errorBag);
    }

    public function errors($key = null)
    {
        return $key ? $this->errorBag->errors[$key] : $this->errorBag->errors;
    }

    public function alias($field)
    {
        return $this->aliases[$field] ?? $field;
    }

    /**
     * @param array $aliases
     */
    public function setAliases(array $aliases): void
    {
        $this->aliases = $aliases;
    }
}