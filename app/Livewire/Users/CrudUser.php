<?php

namespace App\Livewire\Users;

use App\Models\Role;
use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Livewire\Users\ListUser;
use Livewire\Attributes\Validate;
use App\Repositories\Users\UserRepositoryInterface;

class CrudUser extends Component
{
    protected $userRepos;
    protected $roleRepos;

    public $user;
    public $action;
    public $name;
    public $username;
    public $password;
    public $roles;
    public $role_id;

    public function mount() {
        $this->roles = Role::all();
    }

    public function boot(UserRepositoryInterface $userRepos) {
        $this->userRepos = $userRepos;
    }

    public function rules() {
        return [
            'name' => ['required'],
            'username' => [
                'required',
                Rule::unique('users')->ignore($this->user->id ?? 0),
            ],
            'password' => ['required'],
            'role_id' => ['gt:0'],
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Vui lòng nhập họ & tên.',
            'username.required' => 'Vui lòng nhập tên tài khoản',
            'username.unique' => 'Tài khoản đã tồn tại',
            'password' => 'Vui lòng nhập mật khẩu',
        ];
    }

    public function modalSetup($id) {
        if ($id > 0) {
            $this->action = 'update';
        } elseif ($id < 0) {
            $this->action = 'delete';
        } else {
            $this->action = 'create';
        }

        $this->user = $this->userRepos->find(abs($id));

        $this->resetErrorBag();
        $this->getData();
    }

    public function getData() {
        $this->name = $this->user->name ?? '';
        $this->username = $this->user->username ?? '';
        $this->password = $this->user->password ?? '';
        $this->role_id = $this->user->role_id ?? 2;
    }

    public function create() {
        $this->resetErrorBag();
        $params = $this->validate();
        $params['password'] = bcrypt($this->password);
        $user = $this->userRepos->create($params);
        $this->postCrud('Đã thêm tài khoản');
    }

    public function update() {
        $this->resetErrorBag();
        $params = $this->validate();
        unset($params['password']);
        $this->user->update($params);
        $this->postCrud('Đã cập nhật tài khoản');
    }

    public function delete() {
        $this->user->delete();
        $this->postCrud('Đã xóa tài khoản');
    }

    public function postCrud($message = '') {
        $this->dispatch('refresh')->to(ListUser::class);
        $this->dispatch('close-crud-user-modal');
        $this->dispatch('show-message',
            type: 'success', 
            message: $message,
        );
    }

    public function render()
    {
        return view('admin.sections.users.livewire.crud-user');
    }
}
