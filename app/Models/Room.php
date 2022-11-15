<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = "rooms";

    protected $fillable = [
        "id",
        "number",
        "floor",
        "description",
        "status",
        "building_id"
    ];

    public $timestamps = true;

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id', 'id');
    }

}
