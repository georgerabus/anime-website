<div class="comment mt-3" id="comment-{{ $comment->id }}">
    <div class="card p-3 shadow-sm" style="border: 1px solid #e0e0e0;">
        <div class="d-flex align-items-start mb-2">
            <img style="margin-right: 10px; width: 40px; height: 40px;" 
                 src="{{ $comment->user->photo ? asset('storage/' . $comment->user->photo) : asset('default_photo.jpeg') }}" 
                 alt="pfp" 
                 class="rounded-circle">
            <div class="w-100">
                <div class="d-flex justify-content-between align-items-center">
                    <strong class="text-primary">{{ $comment->user->name }}</strong>
                    <span class="text-muted" style="font-size: 0.9em;">
                        {{ $comment->created_at->diffForHumans() }}
                    </span>
                </div>
                <div class="mt-1" style="font-size: 1em; line-height: 1.5;">
                    {{ $comment->text }}
                </div>
            </div>
        </div>

        <div class="reply-form mt-2">
            <a href="javascript:void(0);" class="text-primary" onclick="toggleReplyForm(this)"><strong>Reply</strong></a>
            <form action="{{ route('comments-reply', ['id' => $comment->id]) }}" method="POST" class="mt-2" style="display: none;">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="reply" rows="2" placeholder="Write a reply..." required></textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-outline-primary">Submit Reply</button>
            </form>
        </div>

        @if ($comment->replies)
            <div class="replies mt-2" style="margin-left: 20px;">
                @foreach ($comment->replies as $reply)
                    @include('partials.comment-item', ['comment' => $reply])
                @endforeach
            </div>
        @endif
    </div>
</div>
