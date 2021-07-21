<!-- Search widget-->
<div class="card mb-4">
    <div class="card-header">جستجو</div>
    <div class="card-body">
        <div class="input-group">
            <form action="{{ route('post.search') }}" method="GET">
                <input class="form-control" name="title" type="text" placeholder="عنوان مورد جستجو را وارد کنید..."
                    aria-label="Enter search term..." aria-describedby="button-search" />
                <button class="btn btn-primary" id="button-search" type="submit">جستجو !</button>
            </form>

        </div>
    </div>
</div>
<!-- Categories widget-->
<div class="card mb-4">
    <div class="card-header">Categories</div>
    <div class="card-body">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-sm-6">
                    <ul class="list-unstyled mb-0">
                        <li><a href="#!">{{ $category->name }}</a></li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Side widget-->
<div class="card mb-4">
    <div class="card-header">Side Widget</div>
    <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature
        the Bootstrap 5 card component!</div>
</div>
