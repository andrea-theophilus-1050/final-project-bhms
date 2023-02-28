<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant;

class Members extends Model
{
    use HasFactory;

    protected $table = 'tb_members';
    protected $primaryKey = 'member_id';

    protected $fillable = [
        'fullname',
        'email',
        'phone_number',
        'gender',
        'dob',
        'id_card',
        'hometown',
        'avatar',
        'citizen_card_front_image',
        'citizen_card_back_image',
    ];

    public function mainTenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
