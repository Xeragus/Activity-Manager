<?php

namespace App\Activity\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateActivityRequest extends FormRequest
{
    public function rules()
    {
        return [
            'description' => 'required',
            'datetime_range' => 'required',
            'time_spent' => 'required'
        ];
    }
}