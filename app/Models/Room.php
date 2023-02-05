<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'tb_rooms';
    protected $primaryKey = 'room_id';

    protected $fillable = [
        'room_name',
        'price',
        'status',
        'room_description',
        'area_id'
    ];

    public function areas()
    {
        return $this->belongsTo('App\Models\Area', 'area_id');
    }
}
