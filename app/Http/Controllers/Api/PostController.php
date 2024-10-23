<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        // $data = Post::all();
        // return response()->json($data, 200);

        // return response()->json(new PostCollection($data), 200);

        DB::listen(function ($query) {
            var_dump($query->sql);
        });
        $data = Post::with(['user',])->paginate(5);

        // $data = Post::paginate(5);
        return new PostCollection($data);
    }

    public function show($id)
    {
        $data = Post::find($id);

        if (is_null($data)) {
            return response()->json([
                'message' => 'Resource not found!'
            ], 404);
        }

        // return response()->json($data, 200);

        // return new PostResource($data);
        return response()->json(new PostResource($data), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:5',
        ]);

        $data = Post::create($validatedData);

        return response()->json($data, 201);
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:5',
        ]);

        $data = Post::find($id);

        if (is_null($data)) {
            return response()->json([
                'message' => 'Resource not found!'
            ], 404);
        }

        $data->update($validatedData);

        return response()->json($data, 200);
    }


    public function destroy($id)
    {
        $data = Post::find($id);

        if (is_null($data)) {
            return response()->json([
                'message' => 'Resource not found!'
            ], 404);
        }

        $data->delete();
        return response()->json(null, 204);
    }
}
