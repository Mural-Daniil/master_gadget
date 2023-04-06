<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'phone_number',
        'date_of_birth',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date:d-m-Y',
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
    ];

    public function getFullNameAttribute()
    {
        return $this->last_name . ' ' . mb_substr($this->first_name,0,1) . '. ' . mb_substr($this->patronymic,0,1) . '. ' ;
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
     // notice that here the attribute name is in snake_case
     protected $appends = ['full_name'];

     public function getAllRoles(): Collection
    {
        /** @var Collection $roles */
        $roles = $this->roles;

        return $roles->sort()->values();
    }
}
