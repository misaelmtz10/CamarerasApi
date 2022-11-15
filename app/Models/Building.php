<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $table = "buildings";

    protected $fillable = [
        "id",
        "name",
        "status"
    ];

    public $timestamps = true;

    public function rooms()
    {
        return $this->hasMany(Room::class, 'id');
    }

}
