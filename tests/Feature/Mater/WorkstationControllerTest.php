<?php

namespace Tests\Feature\Master;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Workstation;

class WorkstationControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function testWorkstationCreation()
    {
        // Pengujian pembuatan item baru
        $dataInput = [
            'nama' => 'Neem',
            'status' => 1,
            // Sesuaikan dengan atribut dan data yang diperlukan
        ];

        $response = $this->post('/work/store', $dataInput);

        $response->assertStatus(302); // Pastikan respons redirect setelah pembuatan
        $this->assertDatabaseHas('workstation', $dataInput); // Pastikan data masuk ke basis data
    }
    public function testWorkstationReading()
    {
        // Pengujian membaca item
        $item = Workstation::factory()->create();

        $response = $this->get("/work/show/{$item->id}");

        $response->assertStatus(200); // Pastikan respons sukses (HTTP 200)
    }

    public function testWorkstationUpdating()
    {
        // Pengujian pembaruan item
        $item = Workstation::factory()->create();

        $dataUpdate = [
            'nama' => 'Ned',
            'status' => 0,
            // Sesuaikan dengan atribut dan data yang diperlukan untuk pembaruan
        ];

        $response = $this->put("/work/update/{$item->id}", $dataUpdate);

        $response->assertStatus(302); // Pastikan respons redirect setelah pembaruan
        $this->assertDatabaseHas('workstation', $dataUpdate); // Pastikan data terupdate di basis data
    }

    public function testWorkstationDeletion()
    {
        // Pengujian penghapusan item
        $item = Workstation::factory()->create();

        $response = $this->delete("/work/hapus/{$item->id}");

        $response->assertStatus(302); // Pastikan respons redirect setelah penghapusan
        $this->assertDatabaseMissing('workstation', ['id' => $item->id]); // Pastikan data terhapus dari basis data
    }
}
