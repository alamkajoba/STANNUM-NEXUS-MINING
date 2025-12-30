<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\RelationTypeEnum;

class FamilyState extends Model
{
    protected $fillable = [
        'firstName','middleName','lastName','birthTown','birthDate','relationType','gender','employee_id','user_id'
    ];

    protected $casts = [
        'birthDate' => 'date',
        'relationType' => RelationTypeEnum::class,
    ];

    //RelationShips
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
