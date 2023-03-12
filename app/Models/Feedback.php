<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'tb_feedbacks';
    protected $primaryKey = 'feedback_id';

    protected $fillable = [
        'content',
        'status',
        'anonymous',
        'tenant_id'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'tenant_id');
    }
}
