<?php
namespace App\Services;

use App\Models\HcrKotorInput;
use App\Models\MasterJenisRambang;
use App\Models\RambangBasahInput;
use App\Models\HcrKotorStock;
use App\Models\RambangBasahStock;
use Illuminate\Http\Request;
use App\Models\GradingHalusStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class InputRambangBasahService
{
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Check if $dataArray or $tableDataArray is empty
        if (empty($dataArray)) {
            return response()->json([
                'success' => false,
                'message' => 'Data array atau data susut atau kontribusi kosong. Tidak ada data untuk disimpan.',
            ], 400);
        }

        // Loop through each item in dataArray
        foreach ($dataArray as $key => $data) {
            // Merge data from $dataArray and $tableDataArray
            $mergedData = array_merge($data);

            // Validate each item in dataArray
            $validator = Validator::make($mergedData, [
                'id_box_hcr_kotor' => 'required', // Change with appropriate field name
                'berat' => 'required', // Change with appropriate field name
                // ... add other validations as needed
            ]);

            // If validation fails, return error message
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed: ' . $validator->errors()->first(),
                ], 400);
            } else {
                try {
                    DB::beginTransaction();

                    // Create instance of GradingHalusInput
                    // InputRambangBasah::create($mergedData);
                    RambangBasahInput::create([
                        'id_box_hcr_kotor'      => $mergedData['id_box_hcr_kotor'],
                        'tanggal_cabut'         => $mergedData['tanggal_cabut'],
                        'jenis_hcr_kotor'         => $mergedData['jenis_hcr_kotor'],
                        'berat_hcr_kotor'         => $mergedData['berat_hcr_kotor'],
                        'jenis_rambang'         => $mergedData['jenis_rambang'],
                        'berat'           => $mergedData['berat'],
                        'keterangan'           => $mergedData['keterangan'],
                        'status'             => $mergedData['status'] ?? 1,
                        'user_created'             => $mergedData['user_created'] ?? 1,
                    ]);

                    $grading = RambangBasahStock::where('id_box_hcr_kotor', $mergedData['id_box_hcr_kotor'])
                        ->where('jenis_rambang', $mergedData['jenis_rambang'])
                        ->first();

                    if ($grading) {
                        // Update existing grading data
                        $grading->update([
                            'berat_masuk'       => $grading->berat_masuk + ($mergedData['berat'] ?? 0),
                            'sisa_berat'       => $grading->sisa_berat + ($mergedData['berat'] ?? 0),
                        ]);
                    } else {
                        // Create new grading data
                        RambangBasahStock::create([
                            'unit'                  => $mergedData['unit'] ?? 'Rambang',
                            'id_box_hcr_kotor'      => $mergedData['id_box_hcr_kotor'],
                            'jenis_rambang'         => $mergedData['jenis_rambang'],
                            'berat_masuk'           => $mergedData['berat'],
                            'berat_keluar'           => $mergedData['berat_keluar'] ?? 0,
                            'sisa_berat'             => $mergedData['berat'] ?? 0,
                        ]);
                    }

                    $itemObject = (object) $mergedData;

                    $stockhcr = HcrKotorStock::where('id_box_hcr_kotor', $itemObject->id_box_hcr_kotor)
                    ->first();

                    // Periksa apakah objek model ditemukan
                    if (!$stockhcr) {
                        // Lakukan tindakan yang sesuai jika objek model tidak ditemukan
                        // Contoh: Menampilkan pesan error atau mengembalikan respons
                        return redirect()->back()->with('error', 'Data tidak ditemukan.');
                    }

                    // Menghitung total berat keluar
                    $totalBeratKeluar = $stockhcr->berat_keluar;

                    // Menghitung total berat masuk
                    $totalBeratMasuk = $itemObject->berat_masuk;

                    // Menambahkan berat baru ke total berat keluar
                    $beratBaru = $itemObject->berat ?? 0;
                    $totalBeratKeluar += $beratBaru;

                    // Menghitung sisa berat berdasarkan total berat masuk dan total berat keluar
                    $sisaBerat = $totalBeratMasuk - $totalBeratKeluar;

                    $data = [
                        'berat_keluar' => $totalBeratKeluar,
                        'sisa_berat'   => max($sisaBerat, 0) // Pastikan sisa berat tidak negatif
                    ];

                    // Update data pada objek model
                    $stockhcr->update($data);

                    // Ambil semua item yang sesuai dengan kriteria
                    // $existingItems = PreGradingHalusAddingStock::where('nomor_grading', $itemObject->nomor_grading)
                    //     ->where('nomor_batch', $itemObject->nomor_batch)
                    //     ->get();

                    // foreach ($existingItems as $existingItem) {

                    //     // Update data dengan nilai baru
                    //     $existingItem->update([
                    //         // Update data PreGradingHalusAddingStock
                    //         'status_stock' => $itemObject->statuss ?? 0,
                    //         'berat_adding' => $itemObject->berat_addings ?? 0,
                    //         'pcs_adding'   => $itemObject->pcs_addings ?? 0,
                    //         'total_modal'  => $itemObject->total_modals ?? 0,
                    //         'user_updated' => $itemObject->user_created ?? "There isn't any",
                    //     ]);
                    // }

                    $existingItem = HcrKotorInput::where('id_box_hcr_kotor', $itemObject->id_box_hcr_kotor)
                    ->get();

                    $dataToUpdate = [
                        'status'                => $itemObject->status ?? 0,
                    ];

                    if ($existingItem) {
                        foreach ($existingItem as $existingItems) {
                            $existingItems->update($dataToUpdate);
                        }
                    }

                    // $existingItems = MasterJenisRambang::where('jenis', $itemObject->jenis_rambang)
                    // ->get();

                    // $dataToUpdate = [
                    //     'status'                => $itemObject->status ?? 0,
                    // ];

                    // if ($existingItems) {
                    //     foreach ($existingItems as $existingItem) {
                    //         $existingItem->update($dataToUpdate);
                    //     }
                    // }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Failed to save data. ' . $e->getMessage(),
                        'redirectTo' => route('InputRambangBasah.create')
                    ], 504);
                }
            }
        }

        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('InputRambangBasah.index')
        ], 201);
    }

    public function destroy($id)
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data InputRambangBasah berdasarkan id
            $gradingHalusInputs = RambangBasahInput::where('id', $id)->get();

            if ($gradingHalusInputs->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('InputRambangBasah.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($gradingHalusInputs as $gradingHalusInput) {
                // Ambil data GradingHalusStock berdasarkan id_box_hcr_kotor dan jenis_rambang
                $gradingHalusStock = RambangBasahStock::where('id_box_hcr_kotor', $gradingHalusInput->id_box_hcr_kotor)
                    ->where('jenis_rambang', $gradingHalusInput->jenis_rambang)
                    ->first();

                if ($gradingHalusStock) {
                    // Hitung total berat baru
                    $totalBeratBaru = $gradingHalusStock->berat_masuk - $gradingHalusInput->berat;
                    $SisaBerat = $totalBeratBaru - $gradingHalusStock->berat_keluar;
                    // Update data GradingHalusStock dengan berat baru

                    if ($gradingHalusInput->berat >= $gradingHalusStock->berat_masuk) {
                        // Perbarui status pada InputHcrKotor dan MasterJenisRambang
                        $inputHcrKotor = HcrKotorInput::where('id_box_hcr_kotor', $gradingHalusInput->id_box_hcr_kotor);
                        $inputHcrKotor->update([
                            'status' => max($gradingHalusInput->status, 1)
                        ]);

                        $masterJenisRambang = MasterJenisRambang::where('jenis', $gradingHalusInput->jenis_rambang);
                        $masterJenisRambang->update([
                            'status' => max($gradingHalusInput->status, 1)
                        ]);

                        // Hapus data GradingHalusStock jika berat input lebih besar atau sama dengan berat di stok
                        $gradingHalusStock->delete();
                    } else {
                        $gradingHalusStock->update([
                            'berat_masuk' => max($totalBeratBaru, 0),
                            'sisa_berat' => max($SisaBerat, 0),
                        ]);
                    }
                }

                $stockhcr = HcrKotorStock::where('id_box_hcr_kotor', $gradingHalusInput->id_box_hcr_kotor)
                ->first();

                // Periksa apakah objek model ditemukan
                if (!$stockhcr) {
                    // Lakukan tindakan yang sesuai jika objek model tidak ditemukan
                    // Contoh: Menampilkan pesan error atau mengembalikan respons
                    return redirect()->back()->with('error', 'Data tidak ditemukan.');
                }

                // Menghitung total berat keluar
                $totalBeratKeluar = $stockhcr->berat_keluar;

                // Menghitung total berat masuk
                $totalBeratMasuk = $stockhcr->berat_masuk;
                $totalBerat = $gradingHalusInput->berat;

                // Menambahkan berat baru ke total berat keluar
                $beratBaru = $gradingHalusInput->berat ?? 0;

                // Menghitung sisa berat berdasarkan total berat masuk dan total berat keluar
                $Berat = $totalBeratKeluar - $totalBerat;
                $sisaBerat = $totalBeratMasuk - $Berat;

                $data = [
                    'berat_keluar' => max($Berat, 0),
                    'sisa_berat'   => max($sisaBerat, 0) // Pastikan sisa berat tidak negatif
                ];

                // Update data pada objek model
                $stockhcr->update($data);

                // Hapus data InputRambangBasah
                $gradingHalusInput->delete();
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('InputRambangBasah.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('InputRambangBasah.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

}
