@extends('admin.master.main')


@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">افزودن نقش جدید</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ route('admin.roles.store') }}" method="POST">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="alert alert-danger w-50 mx-auto m-2" style="font-size: 0.9rem">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="title-role">عنوان</label>
          <input type="text" name="titleRole" class="form-control" id="title-role" placeholder="عنوان نقش را وارد کنید" value="{{old('titleRole')}}">
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">ثبت</button>
        <a href="{{ route('admin.roles.index') }}" type="submit" class="btn btn-info float-left">لیست نقش ها</a>
      </div>
    </form>
  </div>

@endsection