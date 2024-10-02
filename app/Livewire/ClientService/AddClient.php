<?php

namespace App\Livewire\ClientService;

use Livewire\Component;
use App\Livewire\ClientService\ListClient;
use App\Repositories\Servings\ServingRepositoryInterface;

class AddClient extends Component
{
    protected $servingRepos;

    public $client_id;

    public function boot(ServingRepositoryInterface $servingRepos) {
        $this->servingRepos = $servingRepos;
    }

    public function rules() {
        return [
            'client_id' => ['required'],
        ];
    }

    public function messages() {
        return [
            'client_id.required' => 'Vui lòng nhập mã khách hàng.',
        ];
    }

    public function modalSetup() {
        $this->resetErrorBag();
        $this->client_id = '';
    }

    public function save() {
        $this->resetErrorBag();
        $params = $this->validate();
        $user_id = auth()->user()->id;
        $this->servingRepos->updateOrCreate(['user_id' => $user_id], $params);
        $this->postCrud('Đã thêm khách hàng');
    }

    public function postCrud($message = '') {
        // $this->dispatch('refresh')->to(ListClient::class);
        $this->dispatch('close-add-client-modal');
        $this->dispatch('show-message',
            type: 'success', 
            message: $message,
        );
    }

    public function render()
    {
        return view('admin.sections.client-service.livewire.add-client');
    }
}
