<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;

//use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    // use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'firstname',
        'lastname',
        'about',
        'availableDays',
        'availableHours',
        'workType',
        'workPreference',
        'videoIntro',
        'profileImage',
        'experience',
        'expertise',
        'slug',
        'contactNumber',
        'companyName',
        'companyLocation',
        'user_type',
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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function places()
    {
        return $this->belongsToMany(Place::class, 'place_user','user_id','place_id');
    }

    public function skills() //profile
    {
        return $this->belongsToMany(Skill::class, 'skill_user', 'user_id', 'skill_id');
    }

    public function employments()
    {
        return $this->hasMany(Employment::class, 'user_id', 'id');
    }
}
