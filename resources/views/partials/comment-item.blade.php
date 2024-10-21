<div class="comment mt-3" id="comment-{{ $comment->id }}">
    <div class="comment-text">
        <img style="margin-inline:5px; width: 30px; height: 30px;" 
             src="{{ $comment->user->photo ? asset('storage/' . $comment->user->photo) : asset('default_photo.jpeg') }}" 
             alt="pfp" class="rounded-circle">
        <strong>{{ $comment->user->name }}</strong>: 
        <span class="text-muted" style="font-size: 0.9em;">
            {{ $comment->created_at->diffForHumans() }}
        </span>
    </div>
    <div>
        <span class="comment-text-display">{{ $comment->text }}</span>
        <textarea class="form-control comment-text-edit" style="display:none;" rows="2">{{ $comment->text }}</textarea>
    </div>


    <div class="reply-form mt-2">
        @if (Auth::check())
        @if (Auth::user()->is_admin)
            @if($comment->user_id == Auth::id())
            <button class="btn btn-sm btn-warning edit-comment" onclick="toggleEdit({{ $comment->id }})">Edit</button>
            @endif
            <form action="{{ route('comments-destroy', $comment->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        @endif
        @if (!Auth::user()->is_admin &&  $comment->user_id == Auth::id())
  
        <button class="btn btn-sm btn-warning edit-comment" onclick="toggleEdit({{ $comment->id }})">Edit</button>
        <form action="{{ route('comments-destroy', $comment->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
    @endif
        @endif

        <a href="javascript:void(0);" class="text-primary" onclick="toggleReplyForm(this)">Reply</a>
        <form action="{{ route('comments-reply', ['id' => $comment->id]) }}" method="POST" class="mt-2" style="display: none;">
            @csrf
            <div class="form-group">
                <textarea class="form-control" name="reply" rows="2" placeholder="Write a reply..." required></textarea>
            </div>
            <button type="submit" class="btn btn-sm btn-outline-primary">Submit Reply</button>
        </form>
    </div>

    @if ($comment->replies)
        <div class="replies" style="margin-left: 20px;">
            @foreach ($comment->replies as $reply)
                @include('partials.comment-item', ['comment' => $reply])
            @endforeach
        </div>
    @endif
</div>
<script>
    function toggleEdit(commentId) {
        const commentTextDisplay = document.querySelector(`#comment-${commentId} .comment-text-display`);
        const commentTextEdit = document.querySelector(`#comment-${commentId} .comment-text-edit`);
        const editButton = document.querySelector(`#comment-${commentId} .edit-comment`);

        if (commentTextEdit.style.display === 'none') {
            commentTextDisplay.style.display = 'none';
            commentTextEdit.style.display = 'block';
            editButton.innerText = 'Save';
        } else {
            const newText = commentTextEdit.value;

            // Send the updated comment to the server
            fetch(`/comments/update/${commentId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ text: newText })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    commentTextDisplay.innerText = newText;
                    commentTextDisplay.style.display = 'block';
                    commentTextEdit.style.display = 'none';
                    editButton.innerText = 'Edit';
                } else {
                    alert(data.error);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }
</script>
