<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::count();
        $users = User::count();
        $comments = Comment::count();
        $roles = Role::count();
        return view('admin.index', compact(['posts','users','comments','roles']));
    }
}
