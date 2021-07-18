<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('photo', 'category')->paginate(3);
        return view('admin.posts.list', compact(['posts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.add', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'titlePost' => 'required',
            'slug' => 'required',
            'category' => 'required',
            'description' => 'required',
            'imgPost' => 'required|mimes:png,jpg,jpeg|max:100000',
        ], [
            'titlePost.required' => 'عنوان پست را وارد کنید',
            'slug.required' => 'نام مستعار را وارد کنید',
            'category.required' => 'دسته بندی را انتخاب کنید',
            'description.required' => 'توضیحات را وارد کنید',
            'imgPost.required' => 'تصویر را بارگزاری کنید',
            'imgPost.mimes' => 'فرمت تصویر نامعتبر می باشد',
            'imgPost.max' => 'حجم تصویر بیش از 1 مگابایت می باشد',
        ])->validate();

        $photo = new Photo();
        $file = $request->file('imgPost');
        $name = rand(0, time()) . $file->getClientOriginalName();
        $file->move('images/', $name);
        $photo->name = $name;
        $photo->save();

        $post = new Post();
        $post->title = $request->input('titlePost');
        $post->slug = join("-", explode(" ", $request->input('slug')));
        $post->description = $request->input('description');
        $post->user_id = Auth::id();
        $post->photo_id = $photo->id;
        $post->category_id = $request->input('category');
        if ($post->save()) {
            Session::flash('save-post', 'پست با موفقیت ذخیره شد');
        }

        return redirect('blog/admin/posts');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::with('category')->where('id', $id)->first();
        $categories = Category::all();
        return view('admin.posts.edit', compact(['post', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'titlePost' => 'required',
            'slug' => 'required',
            'category' => 'required',
            'description' => 'required',
        ], [
            'titlePost.required' => 'عنوان پست را وارد کنید',
            'slug.required' => 'نام مستعار را وارد کنید',
            'category.required' => 'دسته بندی را انتخاب کنید',
            'description.required' => 'توضیحات را وارد کنید',
        ])->validate();

        $post = Post::findOrFail($id);
        if ($file = $request->file('imgPost')) {
            $photo = new Photo();
            $name = rand(0, time()) . $file->getClientOriginalName();
            $file->move('images/', $name);
            $photo->name = $name;
            $photo->save();
            $post->photo_id = $photo->id;
        }
        $post->title = $request->input('titlePost');
        $post->slug = join("-", explode(" ", $request->input('slug')));
        $post->description = $request->input('description');
        $post->user_id = Auth::id();
        $post->category_id = $request->input('category');
        if ($post->save()) {
            Session::flash('update-post', 'پست با موفقیت ویرایش شد');
        }

        return redirect('blog/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $photo = Photo::findOrFail($post->photo_id);
        $post->delete();
        $photo->delete();
        Session::flash('delete-post', 'پست با موفقیت حذف شد');
        return redirect('blog/admin/posts');
    }
}
