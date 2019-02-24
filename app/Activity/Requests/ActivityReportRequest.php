<?php

namespace App\Activity\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityReportRequest extends FormRequest
{
    public function rules()
    {
        return [
            'datetime_range' => 'required'
        ];
    }
}