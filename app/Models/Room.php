<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\House;
use App\Models\RentalRoom;


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

    public function houses()
    {
        return $this->belongsTo(House::class, 'house_id');
    }
    public function rentals()
    {
        return $this->hasOne(RentalRoom::class, 'room_id');
    }
}
