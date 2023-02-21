<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $table = 'tb_services';
    protected $primaryKey = 'service_id';

    protected $fillable = [
        'service_name',
        'price',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
