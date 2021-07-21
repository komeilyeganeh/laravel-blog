@extends('admin.master.main')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">نظرات</h3>
                </div>
                @if (Session::has('delete-comment'))
                    <div class="alert alert-success m-2" style="font-size: 0.9rem">{{ session('delete-comment') }}</div>
                @endif
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>شناسه</th>
                                <th>متن</th>
                                <th>پست</th>
                                <th>تاریخ درج</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ Str::limit($comment->description, 30) }}</td>
                                    <td>{{ $comment->post->title }}</td>
                                    <td>{{ $comment->created_at }}</td>
                                    <td>
                                        @if ($comment->status == 0)
                                            <div class="badge badge-danger">تایید نشده</div>
                                            <form action="{{ route('admin.comments.action', $comment->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="action" value="approved">
                                                <button type="submit" class="btn btn-success btn-sm">تایید</button>
                                            </form>
                                        @else
                                            <div class="badge badge-success">تایید شده</div>
                                            <form action="{{ route('admin.comments.action', $comment->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="action" value="unapproved">
                                                <button type="submit" class="btn btn-danger btn-sm">عدم تایید</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.comments.delete', $comment->id) }}"
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
               
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
