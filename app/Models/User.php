<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use App\Models\House;
use App\Models\Tenant;
use App\Models\VNPayPayment;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmail;
use App\Models\Notification;
use App\Models\Revenue;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'tb_user';
    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'name',
        'email',
        'phone',
        'dob',
        'gender',
        'avatar',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function houses()
    {
        return $this->hasMany(House::class, 'user_id');
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class, 'user_id');
    }

    public function paymentVNPay()
    {
        return $this->hasOne(VNPayPayment::class, 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function revenues()
    {
        return $this->hasMany(Revenue::class, 'user_id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }
}
