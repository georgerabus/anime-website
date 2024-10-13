<div class="container">
    <div class="comments-section mt-5">
        <h3 class="mb-4">Comments (3)</h3>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Leave a Comment</h5>
                <form action="{{ route('comments-store') }}" method="POST"> 
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="comment" rows="3" placeholder="Write your comment here..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                </form>
            </div>
        </div>

        <div class="comment-list">
            @foreach ($comments as $comment)
                <div class="media mb-4">
                    <img class="mr-3 rounded-circle" src="https://via.placeholder.com/50" alt="User image">
                    <div class="media-body">
                        <h5 class="mt-0">{{ $comment->user->name }} <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small></h5>
                        {{ $comment->text }}
        
                        <div class="reply-form mt-2">
                            <a href="javascript:void(0);" class="text-primary" onclick="toggleReplyForm(this)">Reply</a>
                            {{-- <form action="{{ route('comments.reply', ['id' => $comment->id]) }}" method="POST" class="mt-2" style="display: none;">
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control" name="reply" rows="2" placeholder="Write a reply..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-sm btn-outline-primary">Submit Reply</button>
                            </form> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>
</div>
{{-- <script>
    function toggleReplyForm(el) {
        const replyForm = el.nextElementSibling;
        if (replyForm.style.display === "none" || replyForm.style.display === "") {
            replyForm.style.display = "block";
        } else {
            replyForm.style.display = "none";
        }
    }
</script> --}}
