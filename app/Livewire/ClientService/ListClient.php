<?php

namespace App\Livewire\ClientService;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Ratings\RatingRepositoryInterface;
use App\Repositories\Surveys\SurveyRepositoryInterface;
use App\Repositories\RatingStaticals\RatingStaticalRepositoryInterface;

class ListClient extends Component
{
    use WithPagination;

    protected $ratingRepos;
    protected $surveyRepos;
    protected $ratingStaticalRepos;

    public $paginate = 10;
    public $params = [];
    public $daterange = '';
    public $ratings;

    protected $listeners = ['refresh' => '$refresh', 'search'];

    public function mount() {
        $today = today()->format('d/m/Y');
        $this->params['from_date'] = $today;
        $this->params['to_date'] = $today;
        $this->daterange = "{$today} - {$today}";
        $this->ratings = $this->ratingRepos->getAll();
    }

    public function boot(
        RatingRepositoryInterface $ratingRepos,
        SurveyRepositoryInterface $surveyRepos,
        RatingStaticalRepositoryInterface $ratingStaticalRepos,
    ) {
        $this->ratingRepos = $ratingRepos;
        $this->surveyRepos = $surveyRepos;
        $this->ratingStaticalRepos = $ratingStaticalRepos;
    }

    public function search($params) {
        $this->params = $params;
    }

    public function render()
    {
        $this->params['user_id'] = Auth::id();
        $rating_staticals = $this->ratingStaticalRepos->filter($this->params, $this->paginate, 'desc');
        $this->ratingStaticalRepos->refresh();
        return view('admin.sections.client-service.livewire.list-client')->with([
            'rating_staticals' => $rating_staticals,
        ]);
    }
}
