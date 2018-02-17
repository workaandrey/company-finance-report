<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyFinanceHistoryRequest extends FormRequest
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
    public function rules()
    {
        return [
            'companySymbol' => 'required|exists:companies,symbol',
            'dateStart' => 'required|date|date_format:Y-m-d',
            'dateEnd' => 'required|date|date_format:Y-m-d|after_or_equal:dateStart',
            'email' => 'required|email'
        ];
    }
}
