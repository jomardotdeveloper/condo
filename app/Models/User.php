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
    public const VENDOR = 3;

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

    public function getParkingFeeAttribute()
    {
        $total = 0;
        $parkings = Parking::where('user_id', $this->id)->get();
        foreach($parkings as $parking)
        {
            $total += ($parking->parking_floor_area * $this->application->unit->cluster->parking_rate) ; 
        }
        return $total;
    }

    public function getMonthlyDueFeeAttribute()
    {
        return $this->application->unit->cluster->monthly_due_rate * $this->application->unit->floor_area;
    }

    public function getElectricFeeAttribute()
    {
        $readings = Reading::where('unit_id', $this->application->unit->id)->where('date_from', '>=', date('Y-m-01'))->where('date_to', '<=', date('Y-m-t'))->where("is_electricity", true)->get();

        $total = 0;

        foreach($readings as $reading)
        {
            $total += $reading->reading;
        }
        return $this->application->unit->cluster->electricity_rate * $total;
    }

    public function getWaterFeeAttribute()
    {
        $readings = Reading::where('unit_id', $this->application->unit->id)->where('date_from', '>=', date('Y-m-01'))->where('date_to', '<=', date('Y-m-t'))->where("is_electricity", false)->get();

        $total = 0;

        foreach($readings as $reading)
        {
            $total += $reading->reading;
        }
        return $this->application->unit->cluster->water_rate * $total;
    }

    public function getPenaltyFeeAttribute()
    {
        $penalty = 0;
        $penalty_percentage = $this->application->unit->cluster->penalty_rate / 100 ;
        $lastInvoice = Debit::where('user_id', $this->id)->where('type', Debit::MONTHLY_DUE)->orderBy('id', 'desc')->first();
        if ($lastInvoice) 
        {

            if($lastInvoice->is_overdue)
            {
                if ($lastInvoice->is_paid) 
                {
                    $penalty = $lastInvoice->total_amount * $penalty_percentage;
                }
                else
                {
                    $penalty = $lastInvoice->total_amount + ($lastInvoice->total_amount * $penalty_percentage);
                }
            }
        }
        return $penalty;
    }




}
