@extends('admin.master.main')


@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">ویرایش نقش "{{ $role->name }}"</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ route('admin.roles.update', $role->id) }}" method="POST">
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
          <label for="title-role">عنوان</label>
          <input type="text" name="titleRole" class="form-control" id="title-role" placeholder="عنوان نقش را وارد کنید" value="{{ $role->name }}">
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">ویرایش</button>
        <a href="{{ route('admin.roles.index') }}" type="submit" class="btn btn-info float-left">لیست نقش ها</a>
      </div>
    </form>
  </div>

@endsection