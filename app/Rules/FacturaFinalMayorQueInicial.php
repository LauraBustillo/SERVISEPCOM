<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FacturaFinalMayorQueInicial implements Rule
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
        $facturaFinal = substr($value, -8);
        $facturaInicial = substr(request()->input('facturaInicial'), -8);

        return intval($facturaFinal) > intval($facturaInicial);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El número de factura final debe ser mayor que el número de factura inicial.';
    }
}
