<?php

namespace Reactmore\TripayPaymentSdk\Validation;

use Reactmore\TripayPaymentSdk\Exceptions\InvalidPayloadException;

class PayloadValidator
{
    public static function validate(array $data, array $rules): void
    {
        $errors = [];

        foreach ($rules as $field => $ruleSet) {
            $ruleSet = is_array($ruleSet) ? $ruleSet : explode('|', $ruleSet);

            foreach ($ruleSet as $rule) {
                if ($rule === 'required' && (!isset($data[$field]) || $data[$field] === '')) {
                    $errors[$field][] = "Field '{$field}' is required";
                }

                if ($rule === 'string' && isset($data[$field]) && !is_string($data[$field])) {
                    $errors[$field][] = "Field '{$field}' must be string";
                }

                if ($rule === 'numeric' && isset($data[$field])) {
                    if (!is_numeric($data[$field])) {
                        $errors[$field][] = "Field '{$field}' must be numeric";
                    }
                }

                if ($rule === 'numeric_strict' && isset($data[$field])) {
                    if (!is_int($data[$field]) && !is_float($data[$field])) {
                        $errors[$field][] = "Field '{$field}' must be a real number (int/float)";
                    }
                }

                if (str_starts_with($rule, 'min:') && isset($data[$field])) {
                    $min = (int) substr($rule, 4);
                    if (strlen((string)$data[$field]) < $min) {
                        $errors[$field][] = "Field '{$field}' must be at least {$min} characters";
                    }
                }

                if (str_starts_with($rule, 'max:') && isset($data[$field])) {
                    $max = (int) substr($rule, 4);
                    if (strlen((string)$data[$field]) > $max) {
                        $errors[$field][] = "Field '{$field}' must not exceed {$max} characters";
                    }
                }
            }
        }

        if (!empty($errors)) {
            throw new InvalidPayloadException($errors, "Payload validation failed");
        }
    }
}
