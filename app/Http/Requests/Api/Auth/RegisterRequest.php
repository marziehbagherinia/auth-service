<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email'        => [ 'sometimes', 'email', 'required_without:phone_number' ],
            'phone_number' => [ 'sometimes', 'string', 'required_without:email' ],
            'password'     => [ 'required', 'string' ],
        ];
    }
}
