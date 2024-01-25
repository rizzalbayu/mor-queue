<?php

namespace Database\Seeders;

use App\Models\Customers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customers::create(['fullname' => 'Moh Rizal', 'dob' => '2000-01-02', 'phonenumber' => '085812345', 'nik' => '1234567890123456', 'medical_report_number' => '657890314']);
        Customers::create(['fullname' => 'Bayu Saputro', 'dob' => '2000-01-01', 'phonenumber' => '085845312', 'nik' => '0987654321123456', 'medical_report_number' => '321341245']);
    }
}
