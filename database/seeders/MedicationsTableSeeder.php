<?php

namespace Database\Seeders;

use App\Models\Medication;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicationsTableSeeder extends Seeder
{
    public function run()
    {
        Medication::factory()->count(10)->create();
    }
}
