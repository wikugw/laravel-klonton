<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            return [
                'name' => 'required|max:191',
                'description' => 'required',
                'adrress' => 'required|max:191',
                'province_id' => 'required|integer',
                'city_id' => 'required|integer',
                'postal_code' => 'required|integer|digits:5',
                'phone' => 'required|numeric|digits_between:12,13',
            ];
        } else {
            return [
                'name' => 'required|max:191',
                'description' => 'required',
                'foto_ktp' => 'required|image',
                'adrress' => 'required|max:191',
                'province_id' => 'required|integer',
                'city_id' => 'required|integer',
                'postal_code' => 'required|integer|digits:5',
                'phone' => 'required|numeric|digits_between:12,13',
                'bank_name' => 'required|max:191',
                'nomor_rekening' => 'required|unique:store_banks|max:191',
                'atas_nama' => 'required|max:191',
            ];
        }
    }
}
