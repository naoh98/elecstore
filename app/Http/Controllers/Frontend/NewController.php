<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\NewModel;
use Illuminate\Http\Request;

class NewController extends Controller
{

    public function index() {
        $posts = NewModel::all();


        return view('frontend.contents.news.index', ['posts' => $posts]);
    }

    public function show($id) {
        $post = NewModel::find($id);
        $recent_posts = NewModel::latest()->get();
        return view('frontend.contents.news.show', ['post' => $post, 'recent_posts' => $recent_posts]);

    }
}
