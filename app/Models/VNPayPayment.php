<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class VNPayPayment extends Model
{
    use HasFactory;

    protected $table = 'tb_payment_vnpay';
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'vnp_TmnCode',
        'vnp_HashSecret',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
