<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Collection\ArticlesCollection;
use App\Http\Resources\Collection\ErrorCollection;
use App\Models\Articles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use stdClass;

class ApiArticlesController extends Controller
{
    //
    public function articles()
    {
        Log::info("articles");
        $posts = Articles::all();
        return response()->json(["articles" => $posts])->setStatusCode(200);
    }

    public function store(Request $request)
    {
        Log::debug('store method');
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the image validation rules as needed
        ]);

        // Store the image
        //$imagePath = $request->file('image')->move('article_images', 'public');

        $fileName = $request->file('image')->getClientOriginalName();
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = $fileName . '-' . time() . '.' . $extension;

        $request->file('image')->move(public_path('article_images'), $fileName);

        $imagePath = asset('article_images/' . $fileName);
        try {

            // Create a new article
            $article = new Articles();
            $article->title = $request->input('title');
            $article->body = $request->input('body');
            $article->image = $imagePath;
            $article->author_id = auth()->user()->id;
            $article->save();
            return (new ArticlesCollection($article))->response()->setStatusCode(202);
        } catch (Exception $e) {
            Log::debug($e);
            $object = new stdClass;
            $object->message = 'Failed to create.';
            return (new ErrorCollection($object))->response()->setStatusCode(422);
        }
    }
}
