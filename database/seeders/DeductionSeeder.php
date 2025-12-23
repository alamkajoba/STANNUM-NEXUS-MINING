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
            'CNSS' => 18, 
            'INPP' => 3,  
            'ONEM' => 0.5,  
            'IPR' => 3, 
            'refundAdvanceAmount' => 20,   
            'deductionSalary' => 0.2, 
            'user_id' => 1, 
        ]);
    }
}
