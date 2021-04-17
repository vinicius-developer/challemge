<?php

namespace App\Rules;

use App\Traits\ClanerStrings;
use Illuminate\Contracts\Validation\Rule;

class Cnpj implements Rule
{

    use ClanerStrings;

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
        $c = $this->sanitize($value);

        if (mb_strlen($c) != 14 || preg_match("/^{$c[0]}{14}$/", $c)) {
            return false;
        }

        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for (
            $i = 0, $n = 0; $i < 12; $n += $c[$i] * $b[++$i]
        ) {
        }

        if ($c[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for (
            $i = 0, $n = 0; $i <= 12; $n += $c[$i] * $b[$i++]
        ) {
        }

        if ($c[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
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
        return 'Esse cnpj não é valido';
    }
}
