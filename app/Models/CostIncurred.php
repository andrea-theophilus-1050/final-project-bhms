<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostIncurred extends Model
{
    use HasFactory;

    protected $table = 'tb_costs_incurred';
    protected $primaryKey = 'id';

    protected $fillable = [
        'price',
        'date',
        'reason',
        'rental_room_id',
    ];

    public function rentalRoom()
    {
        return $this->belongsTo(RentalRoom::class, 'rental_room_id', 'rental_room_id');
    }
}
