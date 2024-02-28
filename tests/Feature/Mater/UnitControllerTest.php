<?php

namespace Tests\Feature\Master;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Unit;
use App\Models\Workstation;

class UnitControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testUnitCreation()
    {
        $item = Workstation::factory()->create();
        // Pengujian pembuatan item baru
        $dataInput = [
            'workstation_id' => $item-> id,
            'nama' => 'Neem',
            'status' => 1,
            // Sesuaikan dengan atribut dan data yang diperlukan
        ];

        $response = $this->post('/unit/store', $dataInput);

        $response->assertStatus(302); // Pastikan respons redirect setelah pembuatan
        $this->assertDatabaseHas('unit', $dataInput); // Pastikan data masuk ke basis data
    }
    public function testUnitReading()
    {
        $work = Workstation::factory()->create();
        // Pengujian membaca item
        $item = unit::factory()->create(['workstation_id' => $work->id]);

        $response = $this->get("/unit/show/{$item->id}");

        $response->assertStatus(200); // Pastikan respons sukses (HTTP 200)
    }

    public function testUnitUpdating()
    {
        $work = Workstation::factory()->create();
        // Pengujian pembaruan item
        $item = unit::factory()->create(['workstation_id' => $work->id]);

        $dataUpdate = [
            'workstation_id' => $work->id,
            'nama' => 'Ned',
            'status' => 0,
            // Sesuaikan dengan atribut dan data yang diperlukan untuk pembaruan
        ];

        $response = $this->put("/unit/update/{$item->id}", $dataUpdate);

        $response->assertStatus(302); // Pastikan respons redirect setelah pembaruan
        $this->assertDatabaseHas('unit', $dataUpdate); // Pastikan data terupdate di basis data
    }

    public function testUnitDeletion()
    {
        $work = Workstation::factory()->create();
        // Pengujian penghapusan item
        $item = unit::factory()->create(['workstation_id' => $work->id]);

        $response = $this->delete("/unit/hapus/{$item->id}");

        $response->assertStatus(302); // Pastikan respons redirect setelah penghapusan
        $this->assertDatabaseMissing('unit', ['id' => $item->id]); // Pastikan data terhapus dari basis data
    }
}
