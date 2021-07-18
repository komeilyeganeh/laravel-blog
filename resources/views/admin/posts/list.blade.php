@extends('admin.master.main')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">پست ها</h3>
                </div>
                @if (Session::has('save-post'))
                    <div class="alert alert-success m-2" style="font-size: 0.9rem">{{ session('save-post') }}</div>
                @endif
                @if (Session::has('update-post'))
                    <div class="alert alert-success m-2" style="font-size: 0.9rem">{{ session('update-post') }}</div>
                @endif
                @if (Session::has('delete-post'))
                    <div class="alert alert-success m-2" style="font-size: 0.9rem">{{ session('delete-post') }}</div>
                @endif
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>شناسه</th>
                                <th>تصویر</th>
                                <th>عنوان</th>
                                <th>توضیحات</th>
                                <th>دسته بندی</th>
                                <th>عملیات</th>
                            </tr>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>
                                        <img src="{{ asset('images/'. $post->photo->name) }}" alt="" width="70px" height="70px" style="border-radius: 50%">
                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ Str::limit($post->description, 10) }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.posts.edit', $post->id) }}"
                                            class="btn btn-secondary btn-sm">ویرایش</a>
                                        <form action="{{ route('admin.posts.destroy', $post->id) }}"
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
                    <a href="{{ route('admin.posts.create') }}" type="submit" class="btn btn-info float-left">افزودن دسته جدید</a>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
