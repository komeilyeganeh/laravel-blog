<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontCommentController extends Controller
{
    public function store(Request $request, $post_id){
        $comment = new Comment();
        $comment-> description = $request->input('comment-text');
        $comment->post_id = $post_id;
        $comment->status = 0;
        $comment->save();
        Session::flash('comment-success', 'نظر با موفقیت ارسال شد و در انتظار تایید مدیران قرار گرفت');
        return back();
    }

    public function reply(Request $request){
        $postId = $request->input('post_id');
        $parentId = $request->input('parent_id');

        $post = Post::findOrFail($postId);
        if($post){
            $comment = new Comment();
            $comment->description = $request->input('desc');
            $comment->parent_id = $parentId;
            $comment->post_id = $post->id;
            $comment->status = 0;
            $comment->save();
        }
        Session::flash('comment-reply-success', 'نظر با موفقیت ارسال شد و در انتظار تایید مدیران قرار گرفت');
        return back();
    }
}
