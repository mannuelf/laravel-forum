<div class="card">
    <div class="card-header">
        {{ dump($reply->created_at) }}
        {{--{{ $reply->owners->name }} said {{ $reply->created_at->diffForHumans() }}--}}
    </div>
    <div class="card-body">
        {{--{{ $reply->body }}--}}
    </div>
</div>