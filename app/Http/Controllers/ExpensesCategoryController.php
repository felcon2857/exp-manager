<?php

namespace App\Http\Controllers;

use App\Models\ExpensesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpensesCategoryController extends Controller
{
    // getExpensesCategory
    public function getAllCategory()
    {
        $category = ExpensesCategory::all()->toArray();
        return response()->json($category);
    }

    public function getOneCategory($id)
    {
        $category = ExpensesCategory::find($id);
        return response()->json($category);
    }
    //save roles
    public function saveCategory(Request $request)
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
        $category = new ExpensesCategory();
        $category->display_name = $request['display_name'];
        $category->descriptions = $request['descriptions'];
        if ($category->save()) {
            return response()->json([
                'message' => 'registration_validation_success',
                'users' => $category->toArray()
            ], 200);
        } else {
            return response()->json([
                'message' => 'registration_validation_failed',
                'error' => $category->errors()
            ], 500);
        }
    }
    // update roles
    public function updateCategory($id, Request $request)
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
        $category = ExpensesCategory::find($id);
        if ($category->update($request->all())) {
        }
        return response()->json([
            'message' => 'registration_validation_updated',
            'users' => $category->toArray()
        ], 200);
    }
    // delete roles
    public function deleteCategory($id)
    {
        $category = ExpensesCategory::find($id);
        $category->delete();

        return response()->json('Category Deleted!');
    }
}
