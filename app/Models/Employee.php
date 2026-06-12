<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Trait\Searchable;

class Employee extends Model
{
    use Notifiable;
    
    protected $fillable = [
        //Personnal info and profil
        'firstName', 
        'middleName', 
        'lastName', 
        'birthDate', 
        'birthTown', 
        'gender', 
        'phone', 
        'emergencyPhone', 
        'mail', 
        'address', 
        'nationality',
        'user_id',
    ];
    protected $casts = [
        'birthDate' => 'date',
    ];

    public function routeNotificationForMail($notification)
    {
        return $this->proMail; 
    }

    // public function routeNotificationForVonage($notification)
    // {
    //     //(format international : 243...)
    //     return $this->proPhone; 
    // }

    //RelationShips
    

    public function enrollment()
    {
        return $this->hasOne(Enrollment::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function familyState()
    {
        return $this->hasMany(familyState::class);
    }

    public function advance()
    {
        return $this->hasOne(Advance::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
