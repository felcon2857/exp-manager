<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    // getRole
    public function getAllRole()
    {
        $roles = Roles::all()->toArray();
        return response()->json($roles);
    }

    public function getOneRole($id)
    {
        $roles = Roles::find($id);
        return response()->json($roles);
    }
    //save roles
    public function saveRole(Request $request)
    {

        $validate = Validator::make(request()->all(), [
            'display_name' => "required | max:255",
            'descriptions' => "required"
        ]);
        if ($validate->fails()) {
            return response()->json([
                'message' => 'registration_validation_error',
                'errors' => $validate->errors()
            ], 422);
        }
        $role = new Roles();
        $role->display_name = $request['display_name'];
        $role->descriptions = $request['descriptions'];
        if ($role->save()) {
            return response()->json([
                'message' => 'registration_validation_success',
                'users' => $role->toArray()
            ], 200);
        } else {
            return response()->json([
                'message' => 'registration_validation_failed',
                'error' => $role->errors()
            ], 500);
        }
    }
    // update roles
    public function updateRole($id, Request $request)
    {
        $validate = Validator::make(request()->all(), [
            'display_name' => "required | max:255",
            'descriptions' => "required"
        ]);
        if ($validate->fails()) {
            return response()->json([
                'message' => 'registration_validation_error',
                'errors' => $validate->errors()
            ], 422);
        }
        $role = Roles::find($id);
        if ($role->update($request->all())) {
        }
        return response()->json([
            'message' => 'registration_validation_updated',
            'users' => $role->toArray()
        ], 200);
    }
    // delete roles
    public function deleteRole($id)
    {
        $role = Roles::find($id);
        $role->delete();

        return response()->json('Role Deleted!');
    }
}
