<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;
use DB;


class ReCaptcha implements Rule
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
        $recaptcha = DB::table('recaptchas')->first();
        if (!$recaptcha == null && $recaptcha->status == 1) {
            $secrete_key = $recaptcha->secret_key;
            $response = Http::get("https://www.google.com/recaptcha/api/siteverify",[
                'secret' => $recaptcha->secret_key,
                'response' => $value
            ]);
            return $response->json()["success"];
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The google recaptcha is required.';
    }
}
