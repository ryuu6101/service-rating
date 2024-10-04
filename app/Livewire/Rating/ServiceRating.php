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

    public $survey;
    public $ratings;

    public function mount() {
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
        ];

        $this->ratingStaticalRepos->create($params);
        $this->survey->delete();
        $this->reset('survey');
    }

    public function render()
    {
        $this->survey = $this->surveyRepos->getByUserId(Auth::id() ?? 0);
        return view('web.survey.livewire.service-rating');
    }
}
