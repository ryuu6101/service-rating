<?php

namespace App\Livewire\Rating;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Surveys\SurveyRepositoryInterface;

class AddSurvey extends Component
{
    protected $surveyRepos;

    public $user_id;
    public $client_id;

    public function mount() {
        $this->user_id = Auth::id();
    }

    public function boot(
        SurveyRepositoryInterface $surveyRepos
    ) {
        $this->surveyRepos = $surveyRepos;
    }

    public function openSurvey() {
        $this->resetErrorBag();
        $this->validate([
            'client_id' => 'required',
        ],[
            'client_id.required' => 'Vui lòng nhập mã khách hàng',
        ]);
        $this->surveyRepos->updateOrCreate(
            ['user_id' => $this->user_id],
            ['client_id' => $this->client_id],
        );

        $this->reset('client_id');
        $this->dispatch('show-message',
            type: 'success', 
            message: 'Đã gửi mã khách hàng đến trang đánh giá.',
        );
    }

    public function render()
    {
        return view('web.home.livewire.add-survey');
    }
}
