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
        // Fetch user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Load associated vehicle details if available
        $vehicle = Vehicle::where('user_id', $id)->first();

        return response()->json([
            'user' => $user,
            'vehicle' => $vehicle
        ]);
    }

}
