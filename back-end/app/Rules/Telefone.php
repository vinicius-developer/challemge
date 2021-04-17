<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Telefone implements Rule
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
        $telefoneResidencial = preg_match('/^\([1-9]{2}\) (?:[2-8]|9[1-9])[0-9]{3}\-[0-9]{4}$/', $value);

        $telefoneCelular = preg_match('/^\([1-9]{2}\) ([1-9])[0-9]{3}\-[0-9]{4}$/', $value);

        return $telefoneResidencial || $telefoneCelular ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Esse telefone não é válido';
    }
}
