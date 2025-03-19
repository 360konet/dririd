<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:15', 'unique:users'],
            'status' => ['required', 'in:rider,driver'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'status' => $data['status'],
        ]);
    }

    public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'status' => 'required|in:rider,driver',
    ]);

    // If validation passes, create user
    $user = User::create([
        'name' => $validated['name'],
        'phone' => $validated['phone'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'status' => $validated['status'],
    ]);

// Generate token
$token = $user->createToken('authToken')->plainTextToken;

return response()->json([
    'user' => $user,
    'token' => $token,
], 201);}

}
