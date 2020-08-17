<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Store_bank;

class StoreBankRequest extends FormRequest
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
                'bank_name' => 'required|max:191',
                // 'nomor_rekening' => 'required|max:191|unique:store_banks,nomor_rekening,' . $this->nomor_rekening,
                'nomor_rekening' => 'required|max:191',
                'atas_nama' => 'required|max:191',
            ];
        } else {
            return [
                'bank_name' => 'required|max:191',
                'nomor_rekening' => 'required|unique:store_banks|max:191',
                'atas_nama' => 'required|max:191',
            ];
        }
    }
}
