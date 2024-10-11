<?php

namespace App\Livewire\Rating;

use App\Models\Rating;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Surveys\SurveyRepositoryInterface;
use App\Repositories\RatingStaticals\RatingStaticalRepositoryInterface;

class ServiceRating extends Component
{
    protected $surveyRepos;
    protected $ratingStaticalRepos;

    public $user_id;
    public $survey;
    public $ratings;
    public $rating_statical;
    public $update_statical;

    public function mount($user_id) {
        $this->user_id = $user_id;
        $this->ratings = Rating::all();
    }

    public function boot(
        SurveyRepositoryInterface $surveyRepos,
        RatingStaticalRepositoryInterface $ratingStaticalRepos
    ) {
        $this->surveyRepos = $surveyRepos;
        $this->ratingStaticalRepos = $ratingStaticalRepos;
    }

    public function rate($rating_id) {
        $params = [
            'user_id' => $this->survey->user_id,
            'client_id' => $this->survey->client_id,
            'rating_id' => $rating_id,
            'recent' => true,
        ];

        $this->rating_statical = $this->ratingStaticalRepos->create($params);
        $this->survey->delete();
        $this->reset('survey');
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
        $this->survey = $this->surveyRepos->getByUserId($this->user_id);
        return view('web.survey.livewire.service-rating');
    }
}
