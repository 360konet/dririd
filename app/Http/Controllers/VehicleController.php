<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    //
    public function registerVehicle(Request $request)
{
    $request->validate([
        'user_id'=> 'required',
        'type' => 'required|in:car,motor',
        'license' => 'required|string',
        'ghana_card' => 'required|string',
        'brand' => 'required|string',
        'model' => 'required|string',
        'year' => 'required|integer|min:1900|max:' . date('Y'),
        'plate' => 'required|string|unique:vehicles,plate',
    ]);

    $vehicle = Vehicle::create([
        'user_id' => $request->user_id,
        'type' => $request->type,
        'status' => 'Pending',
        'license' => $request->license,
        'ghana_card' => $request->ghana_card,
        'brand' => $request->brand,
        'model' => $request->model,
        'year' => $request->year,
        'plate' => $request->plate,
    ]);

    return response()->json(['message' => 'Vehicle registered successfully!', 'vehicle' => $vehicle], 201);

}

}
