<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $table = 'tb_house';
    protected $primaryKey = 'house_id';

    protected $fillable = [
        'house_name',
        'house_address',
        'house_description',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}
