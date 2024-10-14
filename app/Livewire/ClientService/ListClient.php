<?php

namespace App\Livewire\ClientService;

use App\Models\Rating;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Surveys\SurveyRepositoryInterface;
use App\Repositories\RatingStaticals\RatingStaticalRepositoryInterface;

class ListClient extends Component
{
    use WithPagination;

    protected $ratingStaticalRepos;
    protected $surveyRepos;

    public $paginate = 10;
    public $params = [];
    public $daterange = '';
    public $ratings;

    protected $listeners = ['refresh' => '$refresh', 'search'];

    public function mount() {
        $this->params['from_date'] = today()->format('d/m/Y');
        $this->params['to_date'] = today()->format('d/m/Y');
        $this->daterange = today()->format('d/m/Y').' - '.today()->format('d/m/Y');
        $this->ratings = Rating::all();
    }

    public function boot(
        RatingStaticalRepositoryInterface $ratingStaticalRepos,
        SurveyRepositoryInterface $surveyRepos,
    ) {
        $this->ratingStaticalRepos = $ratingStaticalRepos;
        $this->surveyRepos = $surveyRepos;
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
