<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog Post - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('site/styles.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#!">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">پست شده در {{ $post->created_at }}</div>
                        <!-- Post categories-->
                        <a class="badge bg-secondary text-decoration-none link-light"
                            href="#!">{{ $post->category->title }}</a>
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded"
                            src="{{ $post->photo->name ? asset('images/' . $post->photo->name) : 'https://dummyimage.com/700x350/dee2e6/6c757d.jpg' }}"
                            alt="..." /></figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-4">{{ $post->description }}</p>
                    </section>
                </article>
                <!-- Comments section-->
                <section class="mb-5">
                    @if (Session::has('comment-success'))
                        <div class="alert alert-success m-2" style="font-size: 0.9rem">
                            {{ session('comment-success') }}
                        </div>
                    @endif
                    @if (Session::has('comment-reply-success'))
                        <div class="alert alert-success m-2" style="font-size: 0.9rem">
                            {{ session('comment-reply-success') }}
                        </div>
                    @endif
                    <div class="card bg-light">
                        <div class="card-body">
                            <!-- Comment form-->
                            <form class="mb-4" action="{{ route('comment.store', $post->id) }}" method="POST">
                                @csrf
                                <textarea class="form-control" name="comment-text" rows="3"
                                    placeholder="متن دیدگاه ..."></textarea>
                                <input type="submit" value="ارسال" class="btn btn-primary btn-sm mt-3">
                            </form>
                            <!-- Comment with nested comments-->
                            <div class="d-flex mb-4">
                                {{-- <!-- Parent comment-->
                                <div class="flex-shrink-0"><img class="rounded-circle"
                                        src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                <div class="ms-3">
                                    <div class="fw-bold">Commenter Name</div>
                                    If you're going to lead a space frontier, it has to be government; it'll never be
                                    private enterprise. Because the space frontier is dangerous, and it's expensive, and
                                    it has unquantified risks.
                                    <!-- Child comment 1-->
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0"><img class="rounded-circle"
                                                src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">Commenter Name</div>
                                            And under those conditions, you cannot establish a capital-market evaluation
                                            of that enterprise. You can't get investors.
                                        </div>
                                    </div>
                                    <!-- Child comment 2-->
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0"><img class="rounded-circle"
                                                src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">Commenter Name</div>
                                            When you put money directly to a problem, it makes a good headline.
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                                <!-- Single comment-->
                                @include('partial.comments', ['comments'=>$post->comments, 'post'=> $post])
                            </div>
                        </div>
                </section>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                @include('partial.navigation', ['categories'=> $categories])

            </div>
        </div>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Core theme JS-->
    <script src="{{ asset('site/scripts.js') }}"></script>
</body>

</html>
