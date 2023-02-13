<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\Tenant;

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
}
