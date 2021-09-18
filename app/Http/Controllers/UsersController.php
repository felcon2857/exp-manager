<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    // get users
    public function getAllUser()
    {
        $user = User::all()->toArray();
        return response()->json($user);
    }
    public function getOneUser($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    //add user
    public function addUser(Request $request)
    {
        $validate =  Validator::make(request()->all(), [
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:6",
            "roles" => "required",
            "roles_id" => "required"
        ]);
        if ($validate->fails()) {
            return response()->json([
                'message' => 'registration_validation_error',
                'errors' => $validate->errors()
            ], 422);
        }
        $user = new User();
        $user->name = $request["name"];
        $user->email = $request["email"];
        $user->password = Hash::make($request["password"]);
        $user->roles = $request["roles"];
        $user->roles_id = $request["roles_id"];

        if ($user->save()) {
            return response()->json([
                'message' => 'registration_validation_success',
                'users' => $user->toArray()
            ], 200);
        } else {
            return response()->json([
                'message' => 'registration_validation_failed',
                'error' => $user->errors()
            ], 500);
        }
    }
    // update user
    public function updateUser($id, Request $request)
    {
        $validate =  Validator::make(request()->all(), [
            "name" => "required",
            "email" => "required|email|unique:users",
            "roles" => "required",
            "roles_id" => "required"
        ]);
        if ($validate->fails()) {
            return response()->json([
                'message' => 'registration_validation_error',
                'errors' => $validate->errors()
            ], 422);
        }
        $user = User::find($id);
        if ($user->update($request->all())) {
        }
        return response()->json([
            'message' => 'registration_validation_updated',
            'users' => $user->toArray()
        ], 200);
    }
    // delete user
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json("User Deleted!");
    }
}
