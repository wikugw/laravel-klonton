<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'adrress' => 'required|max:191',
            'province_id' => 'required|integer',
            'city_id' => 'required|integer',
            'postal_code' => 'required|integer|digits:5',
            'phone' => 'required|numeric|digits_between:12,13'
        ];
    }
}
