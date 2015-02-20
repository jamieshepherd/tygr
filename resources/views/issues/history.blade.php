<section>
    <h2>Issue history</h2>
    @foreach($issue->issue_history as $update)
        @if(!$update->hidden || \Auth::user()->rank < 3)
        <div class="update {{ $update->type }}">
            <div class="timestamp">{{ $update->created_at }}</div>
            @if($update->type == 'comment')
                    <h3><i class="fa fa-user"></i> {{{ $update->author->name }}} <span class="tag">{{  $update->author->client->name }}</span> @if($update->hidden) <i class="fa fa-eye-slash pointer" alt="Hidden" title="Hidden from client"></i>  @endif</h3>
                    <p>{{{ $update->comment }}}</p>
            @elseif($update->type == 'status')
                @if($update->status == 'created' || $update->status == 'reopened')
                    <h3><i class="fa fa-exclamation-circle">
                @elseif($update->status == 'updated' || $update->status == 'assigned')
                    <h3><i class="fa fa-info-circle">
                @elseif($update->status == 'resolved' || $update->status == 'closed')
                    <h3><i class="fa fa-check-circle">
                @endif
                    </i> {{{ $update->comment }}} <em>by {{{ $update->author->name }}}</em></h3>
            @endif
        </div>
        @endif
    @endforeach
</section>