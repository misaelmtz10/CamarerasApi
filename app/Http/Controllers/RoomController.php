<?php

namespace App\Http\Controllers;

use App\Models\UserHasRoom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class RoomController extends Controller
{
    public function index()
    {
        $user_has_room = UserHasRoom::with('users', 'rooms', 'status_cleaning')->get();
        return $this->getResponse200($user_has_room);
    }

    public function getAllByUser($idBuilding)
    {
        $idUser = auth()->user()->id;
        $user_has_room = DB::select('SELECT uhr.id, uhr.started, uhr.ended, uhr.observations, uhr.evidence, uhr.users_id, uhr.rooms_id, r.number, r.floor, r.description, uhr.status_cleaning_id FROM user_has_room uhr JOIN rooms r ON r.id = uhr.rooms_id JOIN buildings b ON b.id = r.building_id WHERE uhr.users_id = ?  AND b.id = ?', [$idUser, $idBuilding]);
        //$user_has_room = UserHasRoom::where("users_id", "=", 1, "and", )->get();
        return $this->getResponse200($user_has_room);
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $user_has_room = new UserHasRoom();
            //$user_has_room->started = Carbon::now($request->started);
            //$user_has_room->ended = Carbon::now($request->ended);
            //$user_has_room->observations = $request->observations;
            //$user_has_room->evidence = $request->evidence;
            $user_has_room->users_id = $request->users_id;
            $user_has_room->rooms_id = $request->rooms_id;
            $user_has_room->status_cleaning_id = $request->status_cleaning_id;

            $user_has_room->save();
            DB::commit();
            return $this->getResponse201('user_has_room', 'created', $user_has_room);

        } catch (Exception $e) {
            DB::rollBack(); //discard changes
            return $this->getResponse500($e);
        }
    }

    public function update(Request $request, $id)
    {
        //return $request;
        DB::beginTransaction();
        try {
            $user_has_room = UserHasRoom::find($id);
            if ($user_has_room) {
                if ($request->users_id) {
                    $user_has_room->users_id = $request->users_id;
                    $user_has_room->rooms_id = $request->rooms_id;
                    $user_has_room->status_cleaning_id = $request->status_cleaning_id;

                    $user_has_room->update();
                    DB::commit();
                    return $this->getResponse201('user_has_room', 'updated', $user_has_room);
                } else {
                    if ($user_has_room->users_id == auth()->user()->id) { //auth()->user()->id
                        $user_has_room->started = $request->started != null ? Carbon::parse($request->started): $user_has_room->started;
                        $user_has_room->ended = $request->ended != null ? Carbon::parse($request->ended): $user_has_room->ended;
                        $user_has_room->observations = $request->observations != null ? $request->observations : $user_has_room->observations;
                        $user_has_room->evidence = $request->evidence != null ? $request->evidence : null;
                        $user_has_room->status_cleaning_id = $request->status_cleaning_id != null ? $request->status_cleaning_id : $user_has_room->status_cleaning_id;

                        $user_has_room->update();
                        DB::commit();
                        return $this->getResponse201('user_has_room', 'created', $user_has_room);
                    } else {
                        return $this->getResponse403();
                    }

                }

            } else {
                return $this->getResponse404();
            }

        }catch (Exception $e) {
            DB::rollBack(); //discard changes
            return $this->getResponse500($e);
        }
    }
}
