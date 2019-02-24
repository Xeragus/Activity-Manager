<?php

namespace App\Report\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailUrlToUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'access_url' => 'required'
        ];
    }
}