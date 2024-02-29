<?php

namespace Tests\Feature;

use App\Services\HppService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HppServiceTest extends TestCase
{
    private HppService $hppService;
    //sama kayak contruct di controller
    protected function setUp(): void
    {
        parent::setUp();
        $this->hppService = $this->app->make(HppService::class);
    }
    public function testCalculateHpp()
    {
        $keys = [1,2];
        $berats = [10,10];
        $harga_estimasi = [8150,5000];
        $modal = [7400,7400];
        $total_modal = [185000000 , 185000000];
        $total_modal = [185000000 , 185000000];
        $response = $this->hppService->calculate($keys,$berats,$harga_estimasi,$total_modal);
        $expect = array();
        $expect = [
            'keys' => $keys[0],
            'berat' => $berats[0],
            'harga_estimasi' => $harga_estimasi[0],
            'total_harga' => $berats[0]*$harga_estimasi[0],
            'total_modal' => 185000000,
            // 'nilai_laba_rugi' => -0.999289189,
            'nilai_laba_rugi' => (81500+5000 - 185000000)/185000000,
            'nilai_prosentase_total_keuntungan' => -81442.06892,
            'nilai_setelah_dikurangi_keuntungan' => 162942.0689 ,
            'prosentase_harga_gramasi' => 0.619771863,
            'selisih_laba_rugi_kg' => -114576294.68,
            'selisih_laba_rugi_gram' => -11457629.47,
            'hpp' => 11465779.47,
            'total_hpp' => 11465779.47*10,
        ];
        // return $response;
        self::assertEquals($expect, $response[0]);
        
    }
}
