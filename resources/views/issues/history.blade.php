<section>
    <h2>Issue history</h2>
    @foreach($issue->issue_history as $update)
        @if(!$update->hidden && $update->type != 'comment' || \Auth::user()->rank < 3 && $update->type != 'comment')
        <div class="update {{ $update->type }}">
            <div class="timestamp">{{ $update->created_at }}</div>
                @if($update->status == 'created' || $update->status == 'reopened')
                    <h3><i class="fa fa-exclamation-circle">
                @elseif($update->status == 'updated' || $update->status == 'assigned')
                    <h3><i class="fa fa-info-circle">
                @elseif($update->status == 'resolved' || $update->status == 'closed')
                    <h3><i class="fa fa-check-circle">
                @endif
                    </i> {{{ $update->comment }}} <em>by {{{ $update->author->name }}}</em></h3>
        </div>
        @endif
    @endforeach
</section>