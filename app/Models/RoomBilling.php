<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RentalRoom;

class RoomBilling extends Model
{
    use HasFactory;

    protected $table = 'tb_room_billing';
    protected $primaryKey = 'id';

    protected $fillable = [
        'rental_room_id',
        'total_price',
        'paidAmount',
        'debt',
        'date',
        'status'
    ];

    public function rentalRoom()
    {
        return $this->belongsTo(RentalRoom::class, 'rental_room_id', 'rental_room_id');
    }
}
