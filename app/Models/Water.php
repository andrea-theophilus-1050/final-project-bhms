<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Water extends Model
{
    use HasFactory;

    protected $table = 'tb_water_bill';
    protected $primaryKey = 'id';

    protected $fillable = [
        'old_water_index',
        'new_water_index',
        'date',
        'rental_room_id',
    ];

    public function rentalRoom()
    {
        return $this->belongsTo(RentalRoom::class, 'rental_room_id', 'rental_room_id');
    }
}
