<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'firstName', 'middleName', 'lastName', 
        'matricule', 'birthDate', 'birthTown',
        'address', 'phone', 'mail',
        'category_id', 'user_id', 'gender'
    ];

    //RelationShips
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function familyState()
    {
        return $this->hasMany(familyState::class);
    }

    public function advence()
    {
        return $this->hasOne(Advence::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
