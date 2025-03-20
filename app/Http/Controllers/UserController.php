<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;

class UserController extends Controller
{
    //
    public function getUserProfile($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $vehicle = Vehicle::where('user_id', $id)->first() ?? new \stdClass(); // Return an empty object if null

    return response()->json([
        'user' => $user,
        'vehicle' => $vehicle
    ]);
}


}
