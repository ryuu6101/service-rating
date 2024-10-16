<?php

namespace App\Livewire\RatingStaticals;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Livewire\RatingStaticals\ListDetail;
use App\Repositories\Users\UserRepositoryInterface;
use App\Repositories\Ratings\RatingRepositoryInterface;
use App\Repositories\RatingStaticals\RatingStaticalRepositoryInterface;

class StaticalChart extends Component
{
    protected $userRepos;
    protected $ratingRepos;
    protected $ratingStaticalRepos;

    public $users;
    public $user_id;
    public $params = [];
    public $daterange = '';
    public $chart_legend = [];
    public $chart_series = [];

    protected $listeners = ['refresh' => '$refresh', 'search'];

    public function boot(
        UserRepositoryInterface $userRepos,
        RatingRepositoryInterface $ratingRepos,
        RatingStaticalRepositoryInterface $ratingStaticalRepos,
    ) {
        $this->userRepos = $userRepos;
        $this->ratingRepos = $ratingRepos;
        $this->ratingStaticalRepos = $ratingStaticalRepos;
    }

    public function mount() {
        $this->users = $this->userRepos->find(Auth::id())->childs;
        $this->user_id = $this->users->first()->id;
        $this->getChartData();
    }

    public function search($params) {
        unset($params['user_id']);
        unset($params['rating_id']);
        $this->params = $params;
        $this->getChartData();
        $this->dispatch('update-chart');
    }

    public function updated($field) {
        $this->skipRender();
        if (!in_array($field, ['user_id', 'daterange'])) return;
        $this->getChartData();
        $this->dispatch('update-chart');
        $this->dispatch('search', params: $this->params)->to(ListDetail::class);
    }

    public function getChartData() {
        // $user = $this->userRepos->find($this->user_id);
        // $rating_staticals = $user->rating_staticals;
        $this->params['user_id'] = $this->user_id;
        $rating_staticals = $this->ratingStaticalRepos->filter($this->params);
        $ratings = $this->ratingRepos->getAll();

        $this->chart_legend = [];
        $this->chart_series = [];

        foreach ($ratings as $key => $rating) {
            $rating_count = $rating_staticals->where('rating_id', $rating->id)->count();

            $this->chart_legend[] = $rating->title;

            if ($rating_count <= 0) continue;
            $this->chart_series[] = [
                'value' => $rating_count,
                'name' => $rating->title,
            ];
        }

        $no_rating_count = $rating_staticals->where('rating_id', 0)->count();
        if ($no_rating_count > 0) {
            $this->chart_legend[] = 'Không đánh giá';
            $this->chart_series[] = [
                'value' => $no_rating_count,
                'name' => 'Không đánh giá',
            ];
        }
    }

    public function render()
    {
        return view('admin.sections.rating-staticals.livewire.rating-statical-chart');
    }
}
