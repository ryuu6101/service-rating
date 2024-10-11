<?php

namespace App\Livewire\ClientService;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Livewire\ClientService\ListClient;
use App\Repositories\Surveys\SurveyRepositoryInterface;
use App\Repositories\RatingStaticals\RatingStaticalRepositoryInterface;

class AddSurvey extends Component
{
    protected $surveyRepos;
    protected $ratingStaticalRepos;

    public $user_id;
    public $client_id = '';
    public $new_client_id = '';
    public $rating_result;

    public function mount() {
        $this->user_id = Auth::id();
    }

    public function boot(
        SurveyRepositoryInterface $surveyRepos,
        RatingStaticalRepositoryInterface $ratingStaticalRepos,
    ) {
        $this->surveyRepos = $surveyRepos;
        $this->ratingStaticalRepos = $ratingStaticalRepos;
    }

    public function openSurvey() {
        $this->resetErrorBag();
        $this->validate([
            'new_client_id' => 'required',
        ],[
            'new_client_id.required' => 'Vui lòng nhập mã khách hàng',
        ]);
        $survey = $this->surveyRepos->updateOrCreate(
            ['user_id' => $this->user_id],
            ['client_id' => $this->new_client_id],
        );

        $this->client_id = $this->new_client_id;
        $this->reset('new_client_id');
        $this->dispatch('show-message',
            type: 'success', 
            message: 'Đã gửi mã khách hàng đến trang đánh giá.',
        );
    }

    public function check() {
        $rating_statical = $this->ratingStaticalRepos->filter([
            'user_id' => $this->user_id,
            'client_id' => $this->client_id,
            'recent' => true,
        ])->first();

        if (!$rating_statical) {
            $this->skipRender();
            return;
        }

        $this->rating_result = $rating_statical->rating->title;
        $this->dispatch('refresh')->to(ListClient::class);
    }

    public function render()
    {
        $survey = $this->surveyRepos->getByUserId($this->user_id);
        return view('admin.sections.client-service.livewire.add-survey')->with([
            'survey' => $survey,
        ]);
    }
}
