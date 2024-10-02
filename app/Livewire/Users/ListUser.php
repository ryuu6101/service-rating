<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Users\UserRepositoryInterface;

class ListUser extends Component
{
    use WithPagination;

    protected $userRepos;

    public $paginate = 10;
    public $params = [];

    protected $listeners = ['refresh' => '$refresh'];

    public function boot(UserRepositoryInterface $userRepos) {
        $this->userRepos = $userRepos;
    }

    public function toggleUser($id) {
        $user = $this->userRepos->find($id);
        $status = $user->is_actived;

        $user->update(['is_actived' => !$status]);

        $this->dispatch('show-message', 
            type: 'success',
            message: $status ? 'Đã khóa tài khoản' : 'Đã kích hoạt tài khoản',
        );
    }

    public function render()
    {
        $users = $this->userRepos->filter($this->params, $this->paginate);
        return view('admin.sections.users.livewire.list-user')->with([
            'users' => $users,
        ]);
    }
}
