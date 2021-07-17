@extends('admin.master.main')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">دسته بندی ها</h3>
                </div>
                @if (Session::has('save-category'))
                    <div class="alert alert-success m-2" style="font-size: 0.9rem">{{ session('save-category') }}</div>
                @endif
                @if (Session::has('update-category'))
                    <div class="alert alert-success m-2" style="font-size: 0.9rem">{{ session('update-category') }}</div>
                @endif
                @if (Session::has('delete-category'))
                    <div class="alert alert-success m-2" style="font-size: 0.9rem">{{ session('delete-category') }}</div>
                @endif
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>شناسه</th>
                                <th>عنوان</th>
                                <th>نام مستعار</th>
                                <th>عملیات</th>
                            </tr>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="btn btn-secondary btn-sm">ویرایش</a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
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
                    <a href="{{ route('admin.categories.create') }}" type="submit" class="btn btn-info float-left">افزودن دسته جدید</a>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
