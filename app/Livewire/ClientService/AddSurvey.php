<?php

namespace App\Livewire\ClientService;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Livewire\ClientService\ListClient;
use App\Repositories\Users\UserRepositoryInterface;
use App\Repositories\Surveys\SurveyRepositoryInterface;
use App\Repositories\RatingStaticals\RatingStaticalRepositoryInterface;

class AddSurvey extends Component
{
    protected $surveyRepos;
    protected $ratingStaticalRepos;

    public $user;
    public $user_id;
    public $client_id = '';
    public $new_client_id = '';
    public $rating_result;

    public function mount() {
        $this->user = auth()->user();
        $this->user_id = Auth::id();
    }

    public function boot(
        UserRepositoryInterface $userRepos,
        SurveyRepositoryInterface $surveyRepos,
        RatingStaticalRepositoryInterface $ratingStaticalRepos,
    ) {
        $this->userRepos = $userRepos;
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
            message: 'Đã gửi mã số đăng ký đến trang đánh giá.',
        );
    }

    public function cancelSurvey() {
        // $survey = $this->user->survey;
        $survey = $this->surveyRepos->getByUserId($this->user_id);

        if (!$survey) {
            $this->dispatch('show-message',
                type: 'error', 
                message: 'Đã xảy ra lỗi!',
            );

            return;
        }

        $this->ratingStaticalRepos->create([
            'user_id' => $this->user_id,
            'client_id' => $this->client_id,
            'rating_id' => 0,
            'recent' => true,
        ]);

        // $this->surveyRepos->getByUserId($this->user_id)->delete();
        $survey->delete();
        $this->reset('client_id');
        $this->dispatch('refresh')->to(ListClient::class);
        $this->dispatch('show-message',
            type: 'success', 
            message: 'Đã xóa mã đăng ký.',
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

        $this->rating_result = [
            'client_id' => $rating_statical->client_id,
            'rating' => $rating_statical->rating->title,
        ];
        $this->dispatch('refresh')->to(ListClient::class);
    }

    public function render()
    {
        // $survey = $this->user->survey;
        $survey = $this->surveyRepos->getByUserId($this->user_id);
        return view('admin.sections.client-service.livewire.add-survey')->with([
            'survey' => $survey,
        ]);
    }
}
