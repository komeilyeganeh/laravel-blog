@extends('admin.master.main')


@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">ویرایش اطلاعات "{{ $user->name }}"</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="alert alert-danger w-50 mx-auto m-2" style="font-size: 0.9rem">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="form-group">
                    <label for="full-name">نام و نام خانوادگی</label>
                    <input type="text" name="fullName" class="form-control" id="full-name"
                        placeholder=" نام و نام خانوادگی را وارد کنید" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="email">ایمیل</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder=" ایمیل را وارد کنید"
                        value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="password">رمز عبور</label>
                    <input type="password" name="password" class="form-control" id="password"
                        placeholder=" رمز عبور را وارد کنید" value="{{ old('password') }}">
                </div>
                <div class="form-group">
                    <label>نقش</label>
                    <select class="form-control" name="roles[]" multiple>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"  @foreach($user->roles as $r) @if($role->id == $r->id) selected  @endif  @endforeach> {{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="img-profile">تصویر پروفایل</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="imgProfile" id="img-profile">
                            <label class="custom-file-label" for="exampleInputFile">انتخاب فایل</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">ویرایش</button>
                <a href="{{ route('admin.users.index') }}" type="submit" class="btn btn-info float-left">لیست کاربران</a>
            </div>
        </form>
    </div>

@endsection
