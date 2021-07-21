<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-open').click(function() {
            $('.form-reply').css('display', 'none');
            var service = this.id;
            var service_id = '#f-' + service;
            $(service_id).show('slow');
        })
    })
</script>

<div class="d-flex flex-column">
    @foreach ($comments as $comment)
        @if ($comment->status == 1)
            <div class="d-flex flex-column mt-3">
                <div class="d-flex">
                    <div class="flex-shrink-0"><img class="rounded-circle"
                            src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." />
                    </div>
                    <div class="ms-3">
                        <div class="fw-bold">مهمان</div>
                        {{ $comment->description }}
                        <div class="d-flex flex-column align-items-start mt-4">
                            <button class="btn btn-warning btn-open" id="div-comment-{{ $comment->id }}"> پاسخ</button>
                            <form class="mb-4 form-reply" action="{{ route('comment.reply') }}" method="POST"
                                id="f-div-comment-{{ $comment->id }}" style="display: none">
                                @csrf
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <textarea name="desc" rows="3" cols="30"></textarea>
                                <input type="submit" value="ارسال پاسخ" class="btn btn-primary btn-sm mt-3">
                            </form>
                            @include('partial.comments', ['comments' => $comment->replies])
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
