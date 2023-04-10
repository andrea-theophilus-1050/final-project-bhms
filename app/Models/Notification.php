<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tenant;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'tb_notification';
    protected $primaryKey = 'id';

    protected $fillable = [
        'content',
        'url',
        'user_id',
        'tenant_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'tenant_id');
    }
}
