<div class="container">
    <div class="comments-section mt-5">
        <h3 class="mb-4">Comments ({{ $totalCommentsCount}})</h3>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Leave a Comment</h5>
                <form action="{{ route('comments-store', ['anime_id' => $anime->id]) }}" method="POST">
                    @csrf
                    <!-- Automatically set the currently selected episode's ID -->
                    <input type="hidden" name="episode_id" value="{{ $currentEpisode->id }}" required>
                
                    <div class="form-group">
                        <textarea class="form-control" name="comment" rows="3" placeholder="Write your comment here..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                </form>
            </div>
        </div>

        <div class="comment-list">
            @foreach ($comments as $comment)
                @include('partials.comment-item', compact('comment'))
            @endforeach
        </div>
    </div>
</div>
<script>
    function toggleReplyForm(element) {
        const form = element.closest('.reply-form').querySelector('form');
        form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        
        if (form.style.display === 'block') {
            form.querySelector('textarea').focus();
            form.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
</script>
