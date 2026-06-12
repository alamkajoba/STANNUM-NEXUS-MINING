<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'identifiant',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //RelationShips
    public function advance()
    {
        return $this->hasMany(Advance::class);
    }

    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function deducion()
    {
        return $this->hasMany(Deducion::class);
    }

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function familyState()
    {
        return $this->hasMany(familyState::class);
    }
}
