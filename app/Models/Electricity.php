<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electricity extends Model
{
    use HasFactory;

    protected $table = 'tb_electricity_bill';
    protected $primaryKey = 'id';
    protected $fillable = [
        'old_electricity_index',
        'new_electricity_index',
        'date',
        'rental_room_id',
    ];

    public function rentalRoom()
    {
        return $this->belongsTo(RentalRoom::class, 'rental_room_id', 'rental_room_id');
    }

    // public function getElectricityBillAttribute()
    // {
    //     return $this->new_electricity_index - $this->old_electricity_index;
    // }
}
