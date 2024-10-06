<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class SingleComment extends Component
{
    public $comment;
    public $showReplies = false;
    public $showReplyForm = false;

    public function mount($comment)
    {
        $this->comment = $comment;
    }

    public function render()
    {
        return view('livewire.single-comment', [
            'replies' => $this->comment->replies()->latest()->get(),
        ]);
    }
}
