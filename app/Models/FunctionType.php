<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Trait\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Casts\MoneyCast;

class FunctionType extends Model
{
    use Searchable;
    use HasFactory;
    
    protected $searchableColumns = ['nameFunction'];

    protected $fillable = [
        'nameFunction', 
        'amount',  
        'dayAmount', 
        'hourAmount',  
        'workDay', 
        'housing', 
        'transportationCost', 
        'functionVehicle',
        'familialAllocation',
        'user_id'
    ];

    protected $casts = [
        'amount'             => MoneyCast::class,
        'dayAmount'          => MoneyCast::class,
        'hourAmount'         => MoneyCast::class,
        'housing'            => MoneyCast::class,
        'transportationCost' => MoneyCast::class,
        'familialAllocation' => MoneyCast::class,
        'workDay'            => 'integer',
    ];

    protected $attributes = [
        'amount'             => 0,
        'housing'            => 0,
        'transportationCost' => 0,
        'familialAllocation' => 0,
    ];



    //RelationShips

    public function enrollment()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
