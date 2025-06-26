<?php
/**
 * Class BlogPostController
 *
 * @author Subin <subinrabin@gmail.com>
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogPostController extends Controller
{
    // List all blog posts
    public function list(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default 10 per page
        $posts = BlogPost::paginate($perPage);
        return response()->json($posts);
    }

    // Store a new blog post
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'tags' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $request;

        $post = BlogPost::create($request->all());
        return response()->json($post, 201);
    }

    // Update a blog post
    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail(id: $id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'tags' => 'required|string',
            'published_at' => 'nullable|date',
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
          $post = BlogPost::findOrFail($id);
          $post->delete();
          return response()->json(['message' => 'Deleted']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'blog post not found'], 404);
        }
    }
}
