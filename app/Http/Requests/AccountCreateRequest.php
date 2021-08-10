<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'iban' => 'required|max:34|min:5|unique:accounts',
            'client_id' => 'required|exists:clients,id',
        ];
    }
}
