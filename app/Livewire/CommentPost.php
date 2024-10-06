<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class CommentPost extends Component
{
    public $post;
    public $newComment = '';
    public $name = '';

    public function mount($post)
    {
        $this->post = $post;
    }

    public function addComment()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'newComment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'post_id' => $this->post->id,
            'name' => $this->name,
            'content' => $this->newComment,
        ]);

        $this->newComment = '';
        $this->name = '';
        $this->post->refresh();  // تحديث البوست مع التعليقات الجديدة
    }

    public function render()
    {
        return view('livewire.comment-post', [
            'comments' => $this->post->comments()->latest()->get(),
        ]);
    }
}
