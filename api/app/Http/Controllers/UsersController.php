<?php

namespace App\Http\Controllers;

use App\Models\LocationGrid;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $locationGrids = LocationGrid::all()->keyBy('id');

        return compact('users', 'locationGrids');
    }

    public function show(User $user)
    {
        return [
            'user' => $user,
            'locationGrid' => $user->locationGrid,
        ];
    }
}
