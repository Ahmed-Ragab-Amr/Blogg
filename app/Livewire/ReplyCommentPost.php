<?php

namespace App\Livewire;

use App\Models\Reply;
use App\Models\Comment;
use Livewire\Component;

class ReplyCommentPost extends Component
{
    public $comment;
    public $replies;
    public $newReply = '';
    public $name = '';

    public $showReplies = false;  // التحكم في عرض الردود
    public $showReplyForm = false;  // التحكم في عرض نموذج الرد

    public function mount($comment)
    {
        $this->comment = $comment;
        $this->replies = $comment->replies;
    }

    public function addReply()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'newReply' => 'required|string|max:1000',
        ]);

        Reply::create([
            'comment_id' => $this->comment->id,
            'name' => $this->name,
            'content' => $this->newReply,
        ]);

        $this->newReply = '';
        $this->name = '';
        $this->replies = $this->comment->replies()->latest()->get();  // تحديث الردود
        $this->showReplies = true;  // عرض الردود تلقائيًا بعد إضافة رد
    }

    public function render()
    {
        return view('livewire.reply-comment-post', [
            'replies' => $this->replies,
        ]);
    }
}
