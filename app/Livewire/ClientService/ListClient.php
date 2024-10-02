<?php

namespace App\Livewire\ClientService;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\RatingStaticals\RatingStaticalRepositoryInterface;

class ListClient extends Component
{
    use WithPagination;

    protected $ratingStaticalRepos;

    public $paginate = 10;
    public $params = [];

    protected $listeners = ['refresh' => '$refresh', 'search'];

    public function boot(RatingStaticalRepositoryInterface $ratingStaticalRepos) {
        $this->ratingStaticalRepos = $ratingStaticalRepos;
    }

    public function search($params) {
        $this->params = $params;
    }

    public function render()
    {
        $this->params['user_id'] = auth()->user()->id;
        $rating_stasticals = $this->ratingStaticalRepos->filter($this->params, $this->paginate);
        return view('admin.sections.client-service.livewire.list-client')->with([
            'rating_stasticals' => $rating_stasticals,
        ]);
    }
}
