@extends('admin.master.main')


@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">افزودن دسته جدید</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ route('admin.categories.store') }}" method="POST">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="alert alert-danger w-50 mx-auto m-2" style="font-size: 0.9rem">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @if (Session::has('add-category'))
            <div class="alert alert-success m-2" style="font-size: 0.9rem">{{ session('add-category') }}</div>
        @endif
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="title-category">عنوان</label>
          <input type="text" name="titleCategory" class="form-control" id="title-category" placeholder="عنوان دسته را وارد کنید" value="{{old('titleCategory')}}">
        </div>
        <div class="form-group">
          <label for="slug">نام مستعار</label>
          <input type="text" name="slug" class="form-control" id="slug" placeholder="نام مستعار را وارد کنید" value="{{old('slug')}}">
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">ثبت</button>
        <a href="{{ route('admin.categories.index') }}" type="submit" class="btn btn-info float-left">لیست دسته بندی ها</a>
      </div>
    </form>
  </div>

@endsection