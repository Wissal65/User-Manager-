<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Example logic to fetch admin dashboard data
        $user = $request->user();

        if ($user->type === 1) { // Assuming admin role is type 1
            $data = [
                'message' => 'Welcome to admin dashboard!',
                'user' => $user,
                // Add more data as needed
            ];
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
            
        }
    }

//show users
public function getUsers()
{
    try {
        $users = User::all();
        return response()->json(['users' => $users]);
    } catch (\Exception $e) {
        \Log::error('Error fetching users: ' . $e->getMessage());
        return response()->json(['error' => 'Server Error'], 500);
    }
}


//add users
// public function addUser(Request $request)
// {
//     $validated = $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|string|email|max:255|unique:users',
//         // 'password' => 'required|string|min:8',
//         // 'type' => 'required|integer', // Assuming 'type' field for user type
//     ]);

//     $user = User::create([
//         'name' => $validated['name'],
//         'email' => $validated['email'],
//         // 'password' => bcrypt($validated['password']),
//         // 'type' => $validated['type'],
//     ]);

//     return response()->json(['user' => $user], 201);
// }
public function addUser(Request $request)
{
    $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'birthdate' => 'required|date',
        'phone' => 'nullable|string|max:20',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    try {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'birthdate' => $request->input('birthdate'),
            'phone' => $request->input('phone'),
            // 'type' => 0, // Default type to 0
            'password' => bcrypt('12345679'), // Ensure the password is hashed
        ]);

        return response()->json(['user' => $user], 201);
    } catch (\Exception $e) {
        \Log::error('Error adding user: ' . $e->getMessage());
        return response()->json(['error' => 'Server Error', 'message' => $e->getMessage()], 500);
    }
}

public function getUserById($id)
{
    try {
        $user = User::findOrFail($id);
        return response()->json(['user' => $user]);
    } catch (\Exception $e) {
        \Log::error('Error fetching user: ' . $e->getMessage());
        return response()->json(['error' => 'User not found'], 404);
    }
}

public function updateUser(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'birthdate' => 'required|date',
        'phone' => 'nullable|string|max:20',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    try {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json(['user' => $user], 200);
    } catch (\Exception $e) {
        \Log::error('Error updating user: ' . $e->getMessage());
        return response()->json(['error' => 'Server Error', 'message' => $e->getMessage()], 500);
    }
}

public function deleteUser($id)
{
    try {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    } catch (\Exception $e) {
        \Log::error('Error deleting user: ' . $e->getMessage());
        return response()->json(['error' => 'Server Error', 'message' => $e->getMessage()], 500);
    }
}

}
