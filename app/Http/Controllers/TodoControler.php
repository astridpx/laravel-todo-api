<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoControler extends Controller
{

    // * Get all todo's
    public function index()
    {
        $todos  = Todo::all();

        return response()->json([
            'data' => $todos
        ], 200);
    }


    // * Create New Todo
    public function createTodo(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'userId' => "required",
            'title' => "required",
            'body' => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 400);
        }

        $todo = new Todo;

        $todo->userId = $req->userId;
        $todo->title = $req->title;
        $todo->body = $req->body;

        $todo->save();

        return response()->json([
            'message' => 'Todo Successfully Created.'
        ], 200);
    }


    // * Update Todo
    public function updateTodo(Request $req, $id)
    {

        $validator = Validator::make($req->all(), [
            'userId' => "required",
            'title' => "required",
            'body' => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 400);
        }

        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json([
                'message' => 'Todo id not found.'
            ], 404);
        }

        $todo->userId = $req->userId;
        $todo->title = $req->title;
        $todo->body = $req->body;

        $todo->save();


        return response()->json([
            'message' => 'Todo Successfully Updated.'
        ], 200);
    }

    // * Delete Todo
    public function deleteTodo($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json([
                'message' => 'Todo id not found.'
            ], 404);
        }

        $todo->delete();

        return response()->json([
            'message' => 'Todo Successfully Deleted.'
        ], 200);
    }
}
