<!-- _comment_replies.blade.php -->

 @forelse($comments as $comment)
         <div class="media">
            <img class="mr-3" src="{{ $comment->user->userImage() }}" alt="{{ $comment->user->name }}" width="70">
            <div class="media-body">
              <i class="fa fa-user"></i> by <a href="#">{{ $comment->user->name }}</a> 
          | <i class="icon-calendar"></i> {{ $comment->created_at->diffForHumans() }}
              <p>{{ $comment->body }}</p>

              <a href="" id="reply"></a>
                <form method="post" action="{{ route('frontend.comment.reply.store') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="comment_body" class="form-control" />
                        <input type="hidden" name="news_id" value="{{ $news_id }}" />
                        <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-warning btn-sm" value="Reply" />
                    </div>
                </form>

                 @include('frontend.includes._comment_replies', ['comments' => $comment->replies])
            </div>
          </div>
@empty
<p>No comment yet!</p>
@endforelse