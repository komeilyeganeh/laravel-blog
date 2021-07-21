<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;



class FrontPostController extends Controller
{
    public function index($slug){
        $post = Post::with(['photo','category', 'comments' => function($n){ $n->where('status',1)->where('parent_id', null); }])->where('slug', $slug)->first();
        $categories = Category::all();
        return view('page', compact(['post', 'categories']));
    }

    public function searchTitle(Request $request){
        $query = $request->input('title');
        $posts = Post::with('user','category','photo')
          ->where('title', 'like', "%".$query."%")
          ->orderBy('created_at', 'desc')
          ->paginate(3);
        $categories = Category::all();

        return view('search', compact(['posts', 'categories', 'query']));
    }

    
}
