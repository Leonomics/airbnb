<?php

namespace App\Rules;

use App\Sponsor;
use Illuminate\Contracts\Validation\Rule;

class ValidSponsor implements Rule
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
        //impedisce all'utente di modificare i prezzi dei piani di sponsor
        $sponsor = Sponsor::find($value);
        if(Sponsor::find($value)){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Il piano non è disponibile o non esiste';
    }
}
