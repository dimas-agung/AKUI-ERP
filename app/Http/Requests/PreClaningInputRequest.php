<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreClaningInputRequest extends FormRequest
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
            'data.*.doc_no' => 'required|string',
            'data.*.nomor_bstb' => 'required|string',
            'data.*.id_box_grading_kasar' => 'required|string',
            'data.*.nomor_batch' => 'required|string',
            'data.*.nomor_job' => 'required|string',
            'data.*.nama_supplier' => 'required|string',
            'data.*.nomor_nota_internal' => 'required|string',
            'data.*.id_box_raw_material' => 'required|string',
            'data.*.jenis_raw_material' => 'required|string',
            'data.*.jenis_grading' => 'required|string',
            'data.*.berat_keluar' => 'required|numeric', // Menambahkan aturan numeric
            'data.*.pcs_keluar' => 'required|integer', // Menambahkan aturan integer
            'data.*.avg_kadar_air' => 'required|numeric',
            'data.*.tujuan_kirim' => 'required|string',
            'data.*.nomor_grading' => 'required|string',
            'data.*.modal' => 'required|numeric',
            'data.*.total_modal' => 'required|numeric',
            'data.*.keterangan' => 'nullable|string',
        ];
    }
}
