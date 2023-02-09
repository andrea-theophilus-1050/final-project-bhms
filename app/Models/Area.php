<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\House;
use App\Models\Room;

class Area extends Model
{
    use HasFactory;

    protected $table = 'tb_area';
    protected $primaryKey = 'area_id';

    protected $fillable = [
        'area_name',
        'area_description',
        'house_id'
    ];

    public function houses()
    {
        return $this->belongsTo(House::class, 'house_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'area_id');
    }
}
