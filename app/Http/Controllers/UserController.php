<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers()
    {
        $users = User::select('*')->where('status', '=', 1)
                                    ->where('role_id', '=', 2)->get();
        return $this->getResponse200($users);
    }
}
