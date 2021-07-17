@extends('admin.master.main')


@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">ویرایش دسته "{{ $category->name }}"</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ route('admin.categories.update', $category->id) }}" method="POST">
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
          <label for="title-category">عنوان</label>
          <input type="text" name="titleCategory" class="form-control" id="title-category" placeholder="عنوان دسته را وارد کنید" value="{{ $category->name }}">
        </div>
        <div class="form-group">
          <label for="slug">نام مستعار</label>
          <input type="text" name="slug" class="form-control" id="slug" placeholder="نام مستعار را وارد کنید" value="{{ $category->slug }}">
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">ویرایش</button>
        <a href="{{ route('admin.categories.create') }}" type="submit" class="btn btn-info float-left">افزودن دسته جدید</a>
      </div>
    </form>
  </div>

@endsection