<?php
/**
 * Class FaqController
 *
 * @author Subin <subinrabin@gmail.com>
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FaqController extends Controller
{
    // List all blog posts
    public function list(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default 10 per page
        $posts = Faq::paginate($perPage);
        return response()->json($posts);
    }

    // Store a new blog post
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $request;

        $post = Faq::create($request->all());
        return response()->json($post, 201);
    }

    // Update a blog post
    public function update(Request $request, $id)
    {
        $post = Faq::findOrFail(id: $id);

        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
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
          $post = Faq::findOrFail($id);
          $post->delete();
          return response()->json(['message' => 'Deleted']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'faq not found'], 404);
        }
    }
}
