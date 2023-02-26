<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RentalRoom;

class Utility extends Model
{
    use HasFactory;

    protected $table = 'tb_utility';
    protected $primaryKey = 'id';

    protected $fillable = [
        'rental_room_id',
        'old_electricity_index',
        'new_electricity_index',
        'old_water_index',
        'new_water_index',
        'date',
    ];

    public function rental_room()
    {
        return $this->belongsTo(RentalRoom::class, 'rental_room_id', 'rental_room_id');
    }
}
