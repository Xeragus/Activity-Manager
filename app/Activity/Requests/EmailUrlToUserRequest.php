<?php

namespace App\Activity\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailUrlToUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email'
        ];
    }
}