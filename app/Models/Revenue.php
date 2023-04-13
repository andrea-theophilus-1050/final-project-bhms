<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Revenue extends Model
{
    use HasFactory;

    protected $table = 'tb_revenue';
    protected $primaryKey = 'id';

    protected $fillable = [
        'date',
        'total_price',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
