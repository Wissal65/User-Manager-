<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        
        $user = $request->user();

        if ($user->type === 1) { 
            $data = [
                'message' => 'Welcome to admin dashboard!',
                'user' => $user,
            ];
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
            
        }
    }

//show users
// public function getUsers()
// {
//     try {
//         $users = User::all();
//         return response()->json(['users' => $users]);
//     } catch (\Exception $e) {
//         \Log::error('Error fetching users: ' . $e->getMessage());
//         return response()->json(['error' => 'Server Error'], 500);
//     }
// }
public function getUsers(Request $request)
{
    try {
        \Log::info('Fetching users with filters', $request->all());

        $query = User::query()->where('type', 0);

        if ($request->has('name') && $request->input('name') != '') {
            $name = $request->input('name');
            $query->where(function($q) use ($name) {
                $q->where('first_name', 'like', '%' . $name . '%')
                  ->orWhere('last_name', 'like', '%' . $name . '%');
            });
            \Log::info('Name filter applied', ['name' => $name]);
        }

        if ($request->has('birthdate') && $request->input('birthdate') != '') {
            $birthdate = $request->input('birthdate');
            $query->whereDate('birthdate', $birthdate);
            \Log::info('Birthdate filter applied', ['birthdate' => $birthdate]);
        }

        $users = $query->get();
        \Log::info('Users fetched', ['users' => $users]);

        if ($users->isEmpty()) {
            return response()->json(['message' => 'No users found'], 404);
        }

        return response()->json(['users' => $users]);
    } catch (\Exception $e) {
        \Log::error('Error fetching users: ' . $e->getMessage());
        return response()->json(['error' => 'Server Error'], 500);
    }
}




public function addUser(Request $request)
{
    $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'birthdate' => 'required|date_format:Y-m-d',
        'phone' => 'nullable|string|max:20',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    try {
 
 \Log::info('Received birthdate:', ['birthdate' => $request->input('birthdate')]);


 // Create a new user
 $user = new User();
 $user->first_name = $request->input('first_name');
 $user->last_name = $request->input('last_name');
 $user->email = $request->input('email');
 $user->phone = $request->input('phone');
 $user->birthdate = $request->input('birthdate');
 $user->password = bcrypt($request->input('password'));
 $user->save();



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
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->birthdate = $request->input('birthdate');
        $user->save();

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

// public function search(Request $request)
// {
//     try {
//         $query = $request->input('query');

//         $users = User::where('first_name', 'LIKE', "%$query%")->get();

//         return response()->json(['users' => $users]);
//     } catch (\Exception $e) {
//         \Log::error('Error searching users: ' . $e->getMessage());
//         return response()->json(['error' => 'An error occurred while searching for users'], 500);
//     }
// }








}
