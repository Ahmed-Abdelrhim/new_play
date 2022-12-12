<?php

namespace App\Http\Livewire;

use App\Models\BlogPost;
use Livewire\Component;
use Livewire\WithPagination;
class Play extends Component
{
    use WithPagination;
    protected $listeners = ['taskAdded' => '$refresh'];
    protected $paginationTheme = 'bootstrap';
    public $counter = 0;
    public function render()
    {
        $blogPosts = BlogPost::latest()->paginate(10);
        return view('livewire.play',compact('blogPosts'));
    }

    public function add()
    {
        $this->counter ++;
    }
}
