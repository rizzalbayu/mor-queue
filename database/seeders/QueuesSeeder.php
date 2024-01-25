<?php

namespace Database\Seeders;

use App\Models\Queues;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QueuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Queues::create([
            'code' => Str::random(10),
            'status' => 'confirm',
            'remark' => 'Sample remark 1',
            'reservation_date' => now()->addDays(1),
            'confirmed_at' => now()->addDays(1)->subHours(2),
            'served_at' => null,
            'customer_id' => 1,
            'queue_type_id' => 2,
        ]);

        Queues::create([
            'code' => Str::random(10),
            'status' => 'pending',
            'remark' => 'Sample remark 2',
            'reservation_date' => now()->addDays(1),
            'confirmed_at' => null,
            'served_at' => null,
            'customer_id' => 2,
            'queue_type_id' => 1,
        ]);
        
        Queues::create([
            'code' => Str::random(10),
            'status' => 'serve',
            'remark' => 'Sample remark 2',
            'reservation_date' => now()->addDays(1),
            'confirmed_at' => now()->addDays(1)->subHours(2),
            'served_at' => now()->addDays(1)->subHours(3),
            'customer_id' => 2,
            'queue_type_id' => 3,
        ]);
    }
}
