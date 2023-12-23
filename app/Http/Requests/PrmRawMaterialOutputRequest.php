<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrmRawMaterialOutputRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //validate form
            // 'doc_no.*'       => 'required',
            // 'nomor_bstb.*'   => 'required|unique',
            // 'nomor_batch.*'  => 'required',
            // 'id_box'       => 'required',
            // 'nama_supplier'=> 'required',
            // 'jenis'        => 'required',
            // 'berat'        => 'required',
            // 'kadar_air'    => 'required',
            // 'tujuan_kirim' => 'required',
            // 'letak_tujuan' => 'required',
            // 'inisial_tujuan'=> 'required',
            // 'modal'        => 'required',
            // 'total_modal'  => 'required',
            // 'keterangan_item'   => 'required',
            // 'user_created.*'    => 'required',
            // 'user_updated.*'    => 'required'
            'data' => 'required',
            'dataHeader' => 'required',
        ];
    }
}
