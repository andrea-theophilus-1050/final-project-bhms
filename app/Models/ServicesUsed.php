<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RentalRoom;
use App\Models\Services;

class ServicesUsed extends Model
{
    use HasFactory;

    protected $table = 'tb_services_used';
    protected $primaryKey = 'id';

    protected $fillable = [
        'rental_room_id',
        'service_id',
        'service_name',
        'price_if_changed',
    ];

    public function rentalRoom()
    {
        return $this->belongsTo(RentalRoom::class, 'rental_room_id');
    }

    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id');
    }
}
