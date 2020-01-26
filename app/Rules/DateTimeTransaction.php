<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class DateTimeTransaction
 * @package App\Rules
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class DateTimeTransaction implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = strtoupper($value);

        $dateTime = null;
        try {
            $dateTime = \DateTime::createFromFormat('d-M-y H:i:s', $value);
        } catch (\Exception $exception) {
        }

        if (!$dateTime) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid format :attribute.';
    }
}
