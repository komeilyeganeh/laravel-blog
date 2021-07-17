@extends('admin.master.main')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">کاربران</h3>
                </div>
                @if (Session::has('save-user'))
                    <div class="alert alert-success m-2" style="font-size: 0.9rem">{{ session('save-user') }}</div>
                @endif
                @if (Session::has('update-user'))
                    <div class="alert alert-success m-2" style="font-size: 0.9rem">{{ session('update-user') }}</div>
                @endif
                @if (Session::has('delete-user'))
                    <div class="alert alert-success m-2" style="font-size: 0.9rem">{{ session('delete-user') }}</div>
                @endif
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>شناسه</th>
                                <th>تصویر</th>
                                <th>نام و نام خانوادگی</th>
                                <th>نقش</th>
                                <th>ایمیل</th>
                                <th>عملیات</th>
                            </tr>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <img src="{{ isset($user->image_path) ? asset('images/'.$user->image_path) : "https://rpgplanner.com/wp-content/uploads/2020/06/no-photo-available.png"}}" alt="" width="70px" height="70px" style="border-radius: 50%">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.edit',$user->id) }}">{{ $user->name }}</a>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($user->roles as $role)
                                                <li class="list-unstyled text-secondary">{{ $role->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                                            class="d-inline" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route('admin.users.create') }}" type="submit" class="btn btn-info float-left">افزودن کاربر جدید</a>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
