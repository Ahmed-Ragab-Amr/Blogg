<div style="margin-right: 20px;">
    <button class="btn btn-link" wire:click="$toggle('showReplies')">
        عرض الردود ({{ $replies->count() }})
    </button>

    @if ($showReplies)
        @foreach($replies as $reply)
            <div class="ml-4" style="text-align: right;">
                <strong style="font-size: 18px;">{{ $reply->name }}</strong>
                <span class="text-muted"> | {{ \Carbon\Carbon::parse($reply->created_at)->locale('ar')->diffForHumans() }}</span>
                <p>{{ $reply->content }}</p>
            </div>
        @endforeach
    @endif

    <button class="btn btn-link" wire:click="$toggle('showReplyForm')">رد</button>

    @if ($showReplyForm)
        <form wire:submit.prevent="addReply" style="text-align: right;">
            <div class="form-group">
                <input type="text" wire:model="name" class="form-control mb-2" placeholder="اسمك" required>
                <textarea wire:model="newReply" class="form-control mb-2" placeholder="اكتب ردك" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">إرسال</button>
        </form>
    @endif
</div>
