<?php

namespace Database\Seeders;

use App\Models\QueueTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QueueTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QueueTypes::create(['name' => 'Klinik Anak', 'remark' => 'remark']);
        QueueTypes::create(['name' => 'Klinik Dalam', 'remark' => 'remark']);
        QueueTypes::create(['name' => 'Klinik Bedah', 'remark' => 'remark']);
        QueueTypes::create(['name' => 'Klinik Psikologi', 'remark' => 'remark']);
        QueueTypes::create(['name' => 'Klinik Gigi', 'remark' => 'remark']);
    }
}
