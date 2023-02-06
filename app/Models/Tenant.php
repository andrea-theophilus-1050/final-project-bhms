<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
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
        'preResidence',
        'status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
