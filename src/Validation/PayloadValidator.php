<?php

namespace Reactmore\TripayPaymentSdk\Validation;

use Reactmore\TripayPaymentSdk\Exceptions\InvalidPayloadException;

class PayloadValidator
{
    public static function validate(array $data, array $rules): void
    {
        foreach ($rules as $field => $rule) {
            if (!isset($data[$field]) || $data[$field] === '') {
                throw new InvalidPayloadException("Field '{$field}' is required");
            }

            if ($rule === 'string' && !is_string($data[$field])) {
                throw new InvalidPayloadException("Field '{$field}' must be string");
            }

            if ($rule === 'numeric' && !is_numeric($data[$field])) {
                throw new InvalidPayloadException("Field '{$field}' must be numeric");
            }
        }
    }
}
