<?php

namespace Database\Seeders;

use App\Models\Organisasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organisasi::create([
            'id' => '64ebebfc-b234-4abc-a2c2-59cba700844d',
            'identifier' => 'official',
            'value_identifier' => 'PDM BOJONEGORO',
            'pathOf' => null,
            'organitation_name' => 'PDM BOJONEGORO',
            'ihs' =>  '100027612',
            'typecode' => null,
            'typedisplay' =>  null,
            'address_type' => 'physical',
            'address_use' => 'work',
            'address_text' => 'RVXQ+25Q, Kadipaten, Kec. Bojonegoro, Kabupaten Bojonegoro, Jawa Timur 62111',
            'address_line' => "Jl. Teuku Umar",
        ]);
    }
}
