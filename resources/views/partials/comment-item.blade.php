<div class="comment mt-3" id="comment-{{ $comment->id }}">
    <div class="comment-text">
        <img style="margin-inline:5px; width: 30px; height: 30px;" src="{{ $comment->user->photo ? asset('storage/' . $comment->user->photo) : asset('default_photo.jpeg') }}" alt="pfp" class="rounded-circle">
        <strong>{{ $comment->user->name }}</strong>: {{ $comment->text }}
    </div>

    <div class="reply-form mt-2">
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
