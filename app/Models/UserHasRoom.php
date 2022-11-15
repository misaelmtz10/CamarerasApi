<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasRoom extends Model
{
    use HasFactory;

    protected $table = "user_has_room";

    protected $fillable = [
        "id",
        "started",
        "ended",
        "observations",
        "evidence",
        "users_id",
        "rooms_id",
        "status_cleaning_id"
    ];

    public $timestamps = true;

    protected $casts = [
        'started' => 'datetime', 'ended' => 'datetime',
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function rooms(){
        return $this->belongsTo(Room::class);
    }

    public function status_cleaning(){
        return $this->belongsTo(StatusCleaning::class);
    }
}
