<?php

namespace App\Helpers;


class CovertBerat
{
    public function generate_berat_bersih($berat_kotor)
    {
        $berat_bersih = $berat_kotor/1.15;
        return $berat_bersih;
    }
    public function generate_upah_bersih($berat_kotor)
    {
        $berat_bersih = $berat_kotor/1.15;
        return $berat_bersih;
    }
}
