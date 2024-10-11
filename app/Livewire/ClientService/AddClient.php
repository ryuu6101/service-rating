<?php

namespace App\Livewire\ClientService;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Livewire\ClientService\ListClient;
use App\Repositories\Surveys\SurveyRepositoryInterface;

class AddClient extends Component
{
    protected $surveyRepos;

    public $client_id;

    public function boot(SurveyRepositoryInterface $surveyRepos) {
        $this->surveyRepos = $surveyRepos;
    }

    public function rules() {
        return [
            'client_id' => ['required'],
        ];
    }

    public function messages() {
        return [
            'client_id.required' => 'Vui lòng nhập mã số đăng ký.',
        ];
    }

    public function modalSetup() {
        $this->resetErrorBag();
        $this->client_id = '';
    }

    public function save() {
        $this->resetErrorBag();
        $params = $this->validate();
        $user_id = Auth::id();
        $this->surveyRepos->updateOrCreate(['user_id' => $user_id], $params);
        $this->postCrud('Đã mở khảo sát');
    }

    public function postCrud($message = '') {
        $this->dispatch('refresh')->to(ListClient::class);
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
