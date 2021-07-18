@extends('admin.master.main')


@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">ویرایش پست "{{ $post->title }}"</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
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
                    <label for="title-post">عنوان</label>
                    <input type="text" name="titlePost" class="form-control" id="title-post"
                        placeholder="عنوان پست را وارد کنید" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label for="slug">نام مستعار</label>
                    <input type="text" name="slug" class="form-control" id="slug" placeholder="نام مستعار را وارد کنید"
                        value="{{ $post->slug }}">
                </div>
                <div class="form-group">
                    <label>دسته بندی</label>
                    <select class="form-control" name="category">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if($category->id == $post->category->id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>توضیحات</label>
                    <textarea class="form-control" rows="3" name="description"
                        placeholder="توضیحات را وارد کنید ">{{ $post->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="img-post">تصویر پست</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="imgPost" id="img-post">
                            <label class="custom-file-label" for="exampleInputFile">انتخاب فایل</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">ویرایش</button>
                <a href="{{ route('admin.posts.index') }}" type="submit" class="btn btn-info float-left">لیست پست ها</a>
            </div>
        </form>
    </div>

@endsection
