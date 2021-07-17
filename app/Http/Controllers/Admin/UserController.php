<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.list', compact(['users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.add', compact(['roles']));
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
            'fullName' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'roles' => 'required',
            'imgProfile' => 'mimes:png,jpg,jpeg'
        ],[
            'fullName.required' => 'نام و نام خانوادگی را وارد کنید',
            'email.required' => 'ایمیل را وارد کنید',
            'email.unique' => 'این ایمیل قبلا ثبت شده است',
            'password.required' => 'رمز عبور را وارد کنید',
            'password.min' => 'رمز عبور باید بیش از 6 کاراکتر باشد',
            'roles.required' => 'نقش را انتخاب کنید',
            'imgProfile.mimes' => 'فرمت تصویر نامعتبر می باشد'
        ])->validate();

        $user = new User();
        if($file = $request->file('imgProfile')){
            $name = rand(0,time()/3600/24/60) . $file->getClientOriginalName();
            $file->move('images/',$name);
            $user->image_path = $name;
        }
        $user->name = $request->input('fullName');
        $user->email = $request->input('email');
        $user->password = password_hash($request->input('password'),PASSWORD_DEFAULT);
        if($user->save())
            Session::flash('save-user', 'کاربر با موفقیت ذخیره شد');
        $user->roles()->attach($request->input('roles'));
        return redirect('blog/admin/users');
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
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.edit', compact(['user','roles']));
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
            'fullName' => 'required',
            'email' => 'required',
            'imgProfile' => 'mimes:png,jpg,jpeg'
        ],[
            'fullName.required' => 'نام و نام خانوادگی را وارد کنید',
            'email.required' => 'ایمیل را وارد کنید',
            'roles.required' => 'نقش را انتخاب کنید',
            'imgProfile.mimes' => 'فرمت تصویر نامعتبر می باشد'
        ])->validate();

        $user = User::findOrFail($id);
        if($file = $request->file('imgProfile')){
            $name = rand(0,time()/3600/24/60) . $file->getClientOriginalName();
            $file->move('images/',$name);
            $user->image_path = $name;
        }
        $user->name = $request->input('fullName');
        $user->email = $request->input('email');
        if($request->input('password')){
            $user->password = password_hash($request->input('password'),PASSWORD_DEFAULT);
        }
        if($user->save())
            Session::flash('update-user', 'کاربر با موفقیت ویرایش شد');
        $user->roles()->sync($request->input('roles'));
        return redirect('blog/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->image_path)
            unlink(public_path()."/images/".$user->image_path);
        $user->delete();
        Session::flash('delete-user', 'کاربر با موفقیت حذف شد');
        return redirect('blog/admin/users');
    }
}
