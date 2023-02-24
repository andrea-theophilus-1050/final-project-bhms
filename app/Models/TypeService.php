<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeService extends Model
{
    use HasFactory;

    protected $table = 'tb_type_service';
    protected $primaryKey = 'type_id';
    
    protected $fillable = [
        'type_name'
    ];

    public function services()
    {
        return $this->hasMany(Services::class, 'type_id', 'type_id');
    }
}
