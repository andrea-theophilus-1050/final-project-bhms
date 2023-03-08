<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TypeService;

class Services extends Model
{
    use HasFactory;

    protected $table = 'tb_services';
    protected $primaryKey = 'service_id';

    protected $fillable = [
        'service_name',
        'price',
        'description',
        'user_id',
        'type_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function type()
    {
        return $this->belongsTo(TypeService::class, 'type_id');
    }
}
