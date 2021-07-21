<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $posts = Post::with('category','photo', 'user')->orderBy('updated_at', 'desc')->paginate(5);
        $categories = Category::all();
        return view('index', compact(['posts', 'categories']));
    }
}
