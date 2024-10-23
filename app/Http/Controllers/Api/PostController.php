<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::all();
        return response()->json($data, 200);
    }

    public function show($id)
    {
        $data = Post::find($id);
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $data = Post::create($request->all());
        return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {
        $data = Post::find($id);
        $data->update($request->all());
        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $data = Post::find($id);
        $data->delete();
        return response()->json(null, 204);
    }
}
