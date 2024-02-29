<?php

namespace Tests\Feature\Master;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\unit;
use App\Models\BiayaHpp;
use App\Models\Workstation;

class BiayaHppControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testbiayahppCreation()
    {
        // Membuat data workstation
        $workstation = Workstation::factory()->create();

        // Membuat data unit yang terkait dengan workstation
        $unit = Unit::factory()->create(['workstation_id' => $workstation->id]);

        // Pengujian pembuatan data biayahpp
        $dataInput = [
            'unit_id' => $unit->id,
            'jenis_biaya' => 12,
            'biaya_per_gram' => 23,
            'status' => 1,
            // Sesuaikan dengan atribut dan data yang diperlukan
        ];

        // Membuat data biayahpp dengan menggunakan with untuk menentukan hubungan dengan unit
        $response = $this->post('/biayahpp/store', $dataInput);

        $response->assertStatus(302); // Pastikan respons redirect setelah pembuatan
        $this->assertDatabaseHas('biaya_hpp', $dataInput); // Pastikan data masuk ke basis data
    }

    public function testbiayahppReading()
    {
        $work = Workstation::factory()->create();
        $unit = unit::factory()->create(['workstation_id' => $work->id]);
        // Membuat data biayahpp menggunakan factory
        $biayahpp = Biayahpp::factory()->create(['unit_id' => $unit->id]);

        $response = $this->get("/biayahpp/show/{$biayahpp->id}");

        $response->assertStatus(200); // Pastikan respons sukses (HTTP 200)
    }

    public function testbiayahppUpdating()
    {
        $work = Workstation::factory()->create();
        $unit = unit::factory()->create(['workstation_id' => $work->id]);
        // Pengujian pembaruan item
        $item = biayahpp::factory()->create(['unit_id' => $unit->id]);

        $dataUpdate = [
            'unit_id' => $unit->id,
            'jenis_biaya' => 10,
            'biaya_per_gram' => 20,
            'status' => 0,
            // Sesuaikan dengan atribut dan data yang diperlukan untuk pembaruan
        ];

        $response = $this->put("/biayahpp/update/{$item->id}", $dataUpdate);

        $response->assertStatus(302); // Pastikan respons redirect setelah pembaruan
        $this->assertDatabaseHas('biaya_hpp', $dataUpdate); // Pastikan data terupdate di basis data
    }

    public function testbiayahppDeletion()
    {
        $work = Workstation::factory()->create();
        $unit = unit::factory()->create(['workstation_id' => $work->id]);
        // Membuat data biayahpp menggunakan factory
        $biayahpp = Biayahpp::factory()->create(['unit_id' => $unit->id]);


        $response = $this->delete("/biayahpp/hapus/{$biayahpp->id}");

        $response->assertStatus(302); // Pastikan respons redirect setelah penghapusan
        $this->assertDatabaseMissing('biaya_hpp', ['id' => $biayahpp->id]); // Pastikan data terhapus dari basis data
    }

}
