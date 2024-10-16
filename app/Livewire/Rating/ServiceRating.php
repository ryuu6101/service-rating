<?php

namespace App\Livewire\Rating;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Users\UserRepositoryInterface;
use App\Repositories\Ratings\RatingRepositoryInterface;
use App\Repositories\Surveys\SurveyRepositoryInterface;
use App\Repositories\RatingStaticals\RatingStaticalRepositoryInterface;

class ServiceRating extends Component
{
    protected $userRepos;
    protected $ratingRepos;
    protected $surveyRepos;
    protected $ratingStaticalRepos;

    public $user;
    public $user_id;
    public $ratings;
    public $rating_statical;
    public $update_statical;

    public function mount($user_id) {
        $this->user = $this->userRepos->find($user_id);
        $this->user_id = $user_id;
        $this->ratings = $this->ratingRepos->getAll();
    }

    public function boot(
        UserRepositoryInterface $userRepos,
        RatingRepositoryInterface $ratingRepos,
        SurveyRepositoryInterface $surveyRepos,
        RatingStaticalRepositoryInterface $ratingStaticalRepos
    ) {
        $this->userRepos = $userRepos;
        $this->ratingRepos = $ratingRepos;
        $this->surveyRepos = $surveyRepos;
        $this->ratingStaticalRepos = $ratingStaticalRepos;
    }

    public function rate($rating_id) {
        // $survey = $this->user->survey;
        $survey = $this->surveyRepos->getByUserId($this->user_id);

        if (!$survey) {
            $this->dispatch('show-message',
                type: 'error', 
                message: 'Đã xảy ra lỗi!',
            );

            return;
        }

        $params = [
            'user_id' => $survey->user_id,
            'client_id' => $survey->client_id,
            'rating_id' => $rating_id,
            'recent' => true,
        ];

        $this->rating_statical = $this->ratingStaticalRepos->create($params);
        $survey->delete();
    }

    public function reselect() {
        $this->update_statical = $this->rating_statical;
    }

    public function update($rating_id) {
        $this->rating_statical = $this->ratingStaticalRepos->update($this->update_statical->id, [
            'rating_id' => $rating_id,
            'recent' => true,
        ]);
        $this->reset('update_statical');
    }

    public function render()
    {
        // $this->survey = $this->surveyRepos->getByUserId(Auth::id() ?? 0);
        // $this->survey = $this->surveyRepos->getByUserId($this->user_id);
        // $survey = $this->user->survey;
        $survey = $this->surveyRepos->getByUserId($this->user_id);
        return view('web.survey.livewire.service-rating')->with(['survey' => $survey]);
    }
}
