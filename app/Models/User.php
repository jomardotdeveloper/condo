<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const USER = 1;
    public const ADMIN = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'user_type'
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
    ];

    public function application()
    {
        return $this->hasOne(Application::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function getHasTimeInAttribute()
    {
        return $this->attendances()->where('date', date('Y-m-d'))->exists();
    }

    public function getHasTimeOutAttribute()
    {
        return $this->attendances()->where('date', date('Y-m-d'))->whereNotNull('time_out')->exists();
    }

    public function getHasActiveLeaveAttribute()
    {
        return $this->leaves()->where('status', Leave::APPROVED)->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->exists();
    }
}
