<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EventControllerRequest extends FormRequest
{
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
    public function rules(Request $request)
    {
        $rules = [
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'recurrence_time' => 'required',
            'recurrence_day' => 'required',
            'recurrence_duration' => 'required',
        ];

        return $rules;
    }
}
