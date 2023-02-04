<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'tb_area';
    protected $primaryKey = 'area_id';

    protected $fillable = [
        'area_name',
        'area_description',
        'house_id'
    ];

    public function houses()
    {
        return $this->belongsTo('App\Models\House', 'house_id');
    }

    public function rooms()
    {
        return $this->hasMany('App\Models\Room', 'area_id');
    }
}
