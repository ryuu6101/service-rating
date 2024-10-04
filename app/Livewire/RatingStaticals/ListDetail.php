<?php

namespace App\Livewire\RatingStaticals;

use App\Models\Rating;
use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\RatingStaticals\RatingStaticalRepositoryInterface;

class ListDetail extends Component
{    
    use WithPagination;

    protected $ratingStaticalRepos;

    public $paginate = 10;
    public $params = [];

    protected $listeners = ['refresh' => '$refresh', 'search'];

    public function boot(
        RatingStaticalRepositoryInterface $ratingStaticalRepos
    ) {
        $this->ratingStaticalRepos = $ratingStaticalRepos;
    }

    public function search($params) {
        $this->params = $params;
    }

    public function render()
    {
        $list_details = $this->ratingStaticalRepos->filter($this->params, $this->paginate);
        return view('admin.sections.rating-staticals.livewire.list-rating-detail')->with([
            'list_details' => $list_details,
        ]);
    }
}
