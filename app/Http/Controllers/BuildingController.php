<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuildingController extends Controller
{
    public function index ()
    {
        $buildings = Building::all();
        return $this->getResponse200($buildings);
    }

    public function getAllBelongUser()
    {
        $id = auth()->user()->id;
        $buildings = DB::select('SELECT * FROM  buildings b WHERE b.id IN (SELECT r.building_id FROM rooms r JOIN user_has_room uhr ON r.id = uhr.rooms_id JOIN users u ON u.id = uhr.users_id WHERE u.id = ?)', [$id]);
        return $this->getResponse200($buildings);
    }
}
