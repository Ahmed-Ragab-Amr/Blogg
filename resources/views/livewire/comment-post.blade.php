<div class="card-footer" style="direction: rtl;">
    <h6>التعليقات</h6>
    @foreach($comments as $comment)
        <livewire:single-comment :comment="$comment" :wire:key="$comment->id"/>
    @endforeach

    <form wire:submit.prevent="addComment" style="text-align: right;">
        <div class="form-group">
            <input type="text" wire:model="name" class="form-control mb-2" placeholder="اسمك" required>
            <textarea wire:model="newComment" class="form-control mb-2" placeholder="اكتب تعليقك" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">إرسال</button>
    </form>
</div>
