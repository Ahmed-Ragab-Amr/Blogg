<div class="mb-3" style="text-align: right;">
    <strong style="font-size: 18px;">{{ $comment->name }}</strong>
    <span class="text-muted"> | {{ \Carbon\Carbon::parse($comment->created_at)->locale('ar')->diffForHumans() }}</span>
    <p>{{ $comment->content }}</p>

    <livewire:reply-comment-post :comment="$comment" :wire:key="$comment->id"/>
</div>
