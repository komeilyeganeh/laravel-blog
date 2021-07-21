<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::with('post')->orderBy('created_at', 'desc')->paginate(30);
        return view('admin.comments.all', compact(['comments']));
    }

    public function action(Request $request, $id){
        if($request->input('action') == 'approved'){
            $comment = Comment::findOrFail($id);
            $comment->status = 1;
            $comment->save();
        }
        if($request->input('action') == 'unapproved'){
            $comment = Comment::findOrFail($id);
            $comment->status = 0;
            $comment->save();
        }
        return redirect('blog/admin/comments');
    }

    public function delete($id){
        $comment = Comment::findOrFail($id);
        $comment->delete();
        Session::flash('delete-comment', 'نظر با موفقیت حذف شد');
        return redirect('blog/admin/comments');
    }
}
