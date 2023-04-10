<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Members;
use App\Models\RentalRoom;
use App\Models\Feedback;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Notification;

class Tenant extends Authenticatable
{
    use HasFactory;

    protected $table = 'tb_main_tenants';
    protected $primaryKey = 'tenant_id';

    protected $fillable = [
        'fullname',
        'email',
        'phone_number',
        'gender',
        'dob',
        'id_card',
        'hometown',
        'status',
        'user_id',
        'avatar',
        'citizen_card_front_image',
        'citizen_card_back_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->password = Hash::make('12345678');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function members()
    {
        return $this->hasMany(Members::class, 'tenant_id');
    }

    public function rentals()
    {
        return $this->hasOne(RentalRoom::class, 'tenant_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'tenant_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'tenant_id');
    }
}
