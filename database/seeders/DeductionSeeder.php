<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Deduction;

class DeductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deduction = Deduction::create([
            'CNSS' => 0, 
            'INPP' => 0,  
            'ONEM' => 0,  
            'IPR' => 0, 
            'refundAdvanceAmount' => 0,   
            'deductionSalary' => 0, 
            'user_id' => 1, 
        ]);
    }
}
