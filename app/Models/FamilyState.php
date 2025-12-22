<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyState extends Model
{
    protected $fillable = [
        'middleName','lastName','birthTown','birthDate','firstName','relation','gender','employee_id','user_id'
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
