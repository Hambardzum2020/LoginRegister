<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    private const MIN_PASS_LENGTH = 6;
    private const MAX_PASS_LENGTH = 18;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:" . self::MIN_PASS_LENGTH . "max:" . self::MAX_PASS_LENGTH,
            "c_password" => "required|same:password"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Please provide your name",
            "email.required" => "Please provide your E-Mail",
            "email.email" => "Please provide a valid email",
            "password.required" => "Please provide your name",
            "password.min" => "Minimum password length should be " . self::MIN_PASS_LENGTH,
            "password.max" => "Minimum password length should be " . self::MAX_PASS_LENGTH,
            "c_password.required" => "Please confirm your password",
            "c_password.same" => "Password do not match"
        ];
    }
}
