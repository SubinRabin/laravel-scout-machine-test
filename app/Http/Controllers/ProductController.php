<?php
/**
 * Class ProductController
 *
 * @author Subin <subinrabin@gmail.com>
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    // List all blog posts
    public function list(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default 10 per page
        $posts = Product::paginate($perPage);
        return response()->json($posts);
    }

    // Store a new blog post
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        'description' => 'required|string',
        'category' => 'required|string',
        'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $request;

        $post = Product::create($request->all());
        return response()->json($post, 201);
    }

    // Update a blog post
    public function update(Request $request, $id)
    {
        $post = Product::findOrFail(id: $id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();

        $post->update($data);
        return response()->json($post);
    }

    // Delete a blog post
    public function destroy($id)
    {
        try {
          $post = Product::findOrFail($id);
          $post->delete();
          return response()->json(['message' => 'Deleted']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'product not found'], 404);
        }
    }
}
