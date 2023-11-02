<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Http\Requests\StorearticlesRequest;
use App\Http\Requests\UpdatearticlesRequest;
use Exception;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Log;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create_view()
    {
        return view('Admin.Posts.create');
    }

    public function edit_view($id)
    {
        $article = Articles::where('id', $id)->get();
        return view('Admin.edit_article', ['article' => $article]);
    }

    public function edit_store($id, Request $request)
    {

        Log::debug('update method');





        try {
            // Find the article by id and update it
            $article = Articles::find($id);
            if ($request->has('image')) {
                $request->validate([
                    'title' => 'required|max:255',
                    'body' => 'required',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);
                $fileName = $request->file('image')->getClientOriginalName();
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileName = $fileName . '-' . time() . '.' . $extension;

                $request->file('image')->move(public_path('article_images'), $fileName);

                $imagePath = asset('article_images/' . $fileName);

                $article->image = $imagePath;
            } else {
                $request->validate([
                    'title' => 'required|max:255',
                    'body' => 'required',

                ]);
            }
            $article->title = $request->input('title');
            $article->body = $request->input('body');
            $article->author_id = auth()->user()->id;
            $article->save();
        } catch (Exception $e) {
            Log::debug($e);
            return redirect()->route('admin.home')->with('failed', 'Article update failed.');
        }

        Log::debug('updated');

        return redirect()->route('admin.home')->with('success', 'Article updated successfully.');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        Log::debug('store method');
        //
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
        } catch (Exception $e) {
            Log::debug($e);
            return redirect()->route('admin.home')->with('failed', 'Article created failed.');
        }

        Log::debug('stored');


        return redirect()->route('admin.home')->with('success', 'Article created successfully.');
    }

    public function uploadfiles(Request $request)
    {
        if ($request->hasFile('upload')) {

            Log::debug('image exists');

            $fileName = $request->file('upload')->getClientOriginalName();
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '-' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        } else {
            Log::debug("no Images");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    //public function store(StorearticlesRequest $request)
    //{
    //    //
    //}

    /**
     * Display the specified resource.
     */
    public function showdetail($id)
    {
        Log::debug($id);
        $article = Articles::where('id', $id)->get();
        Log::debug($article[0]);
        //dd($article);
        return view('detail', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(articles $articles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatearticlesRequest $request, articles $articles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(articles $articles)
    {
        //
    }
}