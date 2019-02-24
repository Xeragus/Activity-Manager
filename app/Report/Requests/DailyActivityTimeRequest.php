<?php

namespace App\Report\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DailyActivityTimeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'date_range' => 'required'
        ];
    }
}