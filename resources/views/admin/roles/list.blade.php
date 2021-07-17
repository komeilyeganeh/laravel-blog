@extends('admin.master.main')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">نقش ها</h3>
                </div>
                @if (Session::has('save-role'))
                    <div class="alert alert-success m-2" style="font-size: 0.9rem">{{ session('save-role') }}</div>
                @endif
                @if (Session::has('update-role'))
                    <div class="alert alert-success m-2" style="font-size: 0.9rem">{{ session('update-role') }}</div>
                @endif
                @if (Session::has('delete-role'))
                    <div class="alert alert-success m-2" style="font-size: 0.9rem">{{ session('delete-role') }}</div>
                @endif
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>شناسه</th>
                                <th>عنوان</th>
                                <th>عملیات</th>
                            </tr>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.roles.edit', $role->id) }}"
                                            class="btn btn-secondary btn-sm">ویرایش</a>
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}"
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
                    <a href="{{ route('admin.roles.create') }}" type="submit" class="btn btn-info float-left">افزودن نقش جدید</a>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
