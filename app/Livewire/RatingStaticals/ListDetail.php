<?php

namespace App\Livewire\RatingStaticals;

use App\Models\Rating;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Users\UserRepositoryInterface;
use App\Repositories\RatingStaticals\RatingStaticalRepositoryInterface;

class ListDetail extends Component
{    
    use WithPagination;

    protected $userRepos;
    protected $ratingStaticalRepos;

    public $paginate = 10;
    public $params = [];
    public $ratings;

    protected $listeners = ['refresh' => '$refresh', 'search'];

    public function boot(
        UserRepositoryInterface $userRepos,
        RatingStaticalRepositoryInterface $ratingStaticalRepos
    ) {
        $this->userRepos = $userRepos;
        $this->ratingStaticalRepos = $ratingStaticalRepos;
    }

    public function mount() {
        $users = $this->userRepos->find(Auth::id())->childs;
        $this->params['user_id'] = $users->first()->id;
        $this->ratings = Rating::all();
    }

    public function search($params) {
        $this->params = array_merge($this->params, $params);
    }

    public function resetInput() {
        $this->params['client_id'] = '';
        $this->params['rating_id'] = '';
    }

    public function render()
    {
        $list_details = $this->ratingStaticalRepos->filter($this->params, $this->paginate);
        return view('admin.sections.rating-staticals.livewire.list-rating-detail')->with([
            'list_details' => $list_details,
        ]);
    }
}
