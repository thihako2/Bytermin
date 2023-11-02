<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Articles;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $posts = Articles::where('author_id', auth()->user()->id)->get();
        return view('Admin.admin_home', ['articles' => $posts]);
    }
}