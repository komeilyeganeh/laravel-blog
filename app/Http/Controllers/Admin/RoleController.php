<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.list', compact(['roles']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.add');
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
            'titleRole' => 'required'
        ],[
            'titleRole.required' => 'عنوان نقش را وارد کنید'
        ])->validate();

        $role = new Role();
        $role->name = $request->input('titleRole');
        if($role->save())
            Session::flash('save-role', "نقش \"{$role->name}\" با موفقیت ذخیره شد");
        return redirect('blog/admin/roles');
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
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact(['role']));
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
            'titleRole' => 'required'
        ],[
            'titleRole.required' => 'عنوان نقش را وارد کنید'
        ])->validate();

        $role = Role::findOrFail($id);
        $role->name = $request->input('titleRole');
        if($role->save())
            Session::flash('update-role', "نقش  با موفقیت ویرایش شد");
        return redirect('blog/admin/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        if($role->delete())
            Session::flash('delete-role', "نقش  با موفقیت حذف شد");
        return redirect('blog/admin/roles');
    }
}
