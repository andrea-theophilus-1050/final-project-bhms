<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\RoomBilling;
use App\Models\Water;
use App\Models\Electricity;
use App\Models\CostIncurred;
use App\Models\ServicesUsed;

class RentalRoom extends Model
{
    use HasFactory;

    protected $table = 'tb_rental_room';
    protected $primaryKey = 'rental_room_id';

    protected $fillable = [
        'room_id',
        'tenant_id',
        'start_date',
        'end_date',
        'status'
    ];

    public function rooms()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function tenants()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function roomBillings()
    {
        return $this->hasMany(RoomBilling::class, 'rental_room_id', 'rental_room_id');
    }

    public function waterBills()
    {
        return $this->hasMany(Water::class, 'rental_room_id', 'rental_room_id');
    }

    public function electricityBills()
    {
        return $this->hasMany(Electricity::class, 'rental_room_id', 'rental_room_id');
    }

    public function costIncurred()
    {
        return $this->hasMany(CostIncurred::class, 'rental_room_id', 'rental_room_id');
    }

    public function servicesUsed()
    {
        return $this->hasMany(ServicesUsed::class, 'rental_room_id', 'rental_room_id');
    }
}
