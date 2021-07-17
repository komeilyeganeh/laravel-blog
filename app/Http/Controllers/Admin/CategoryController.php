<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.list', compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.add');
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
            'titleCategory' => 'required',
            'slug' => 'required'
        ],[
            'titleCategory.required' => 'عنوان دسته را وارد کنید',
            'slug.required' => 'نام مستعار را وارد کنید'
        ])->validate();

        $category = new Category();
        $category->name = $request->input('titleCategory');
        $category->slug = join('-',explode(' ',$request->input('slug')));
        if($category->save())
            Session::flash('save-category', "دسته \"{$category->name}\" با موفقیت ذخیره شد");
        return redirect('blog/admin/categories');
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
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact(['category']));
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
            'titleCategory' => 'required',
            'slug' => 'required'
        ],[
            'titleCategory.required' => 'عنوان دسته را وارد کنید',
            'slug.required' => 'نام مستعار را وارد کنید'
        ])->validate();

        $category = Category::findOrFail($id);
        $category->name = $request->input('titleCategory');
        $category->slug = join('-',explode(' ',$request->input('slug')));
        if($category->save())
            Session::flash('update-category', "دسته با موفقیت ویرایش شد");
        return redirect('blog/admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if($category->delete())
            Session::flash('delete-category', "دسته با موفقیت حذف شد");
        return redirect('blog/admin/categories');
    }
}
