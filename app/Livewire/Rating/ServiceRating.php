<?php

namespace App\Livewire\Rating;

use App\Models\Rating;
use Livewire\Component;
use App\Repositories\Servings\ServingRepositoryInterface;
use App\Repositories\RatingStaticals\RatingStaticalRepositoryInterface;

class ServiceRating extends Component
{
    protected $servingRepos;
    protected $ratingStaticalRepos;

    public $serving;
    public $ratings;

    public function mount() {
        $this->ratings = Rating::all();
    }

    public function boot(
        ServingRepositoryInterface $servingRepos,
        RatingStaticalRepositoryInterface $ratingStaticalRepos
    ) {
        $this->servingRepos = $servingRepos;
        $this->ratingStaticalRepos = $ratingStaticalRepos;
    }

    public function rate($rating_id) {
        $params = [
            'user_id' => $this->serving->user_id,
            'client_id' => $this->serving->client_id,
            'rating_id' => $rating_id,
        ];

        $this->ratingStaticalRepos->create($params);
        $this->serving->delete();
        $this->reset('serving');
    }

    public function render()
    {
        $this->serving = $this->servingRepos->getByUserId(auth()->user()->id ?? 0);
        return view('web.home.livewire.service-rating');
    }
}
