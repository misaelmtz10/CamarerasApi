<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusCleaning extends Model
{
    use HasFactory;
    protected $table = "status_cleaning";

    protected $fillable = [
        "id",
        "name"
    ];

    public $timestamps = false;

}
