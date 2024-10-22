<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class ChatBox extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $user;
    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function render()
    {
        $users = User::where('id', '!=', auth()->id())
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        return view(
            'livewire.chat-box',
            [
                'users' => $users,
            ]
        );
    }
}
