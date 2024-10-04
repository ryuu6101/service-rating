<?php

namespace App\Livewire\RatingStaticals;

use App\Models\Rating;
use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Users\UserRepositoryInterface;
use App\Repositories\RatingStaticals\RatingStaticalRepositoryInterface;

class ListStatical extends Component
{
    use WithPagination;

    protected $userRepos;
    protected $ratingStaticalRepos;

    public $ratings;
    public $paginate = 10;
    public $params = [];
    public $sort;
    public $staticals;

    protected $listeners = ['refresh' => '$refresh', 'search'];

    public function boot(
        UserRepositoryInterface $userRepos,
        RatingStaticalRepositoryInterface $ratingStaticalRepos
    ) {
        $this->userRepos = $userRepos;
        $this->ratingStaticalRepos = $ratingStaticalRepos;
    }

    public function mount() {
        $this->ratings = Rating::all();
        $this->staticals = $this->getStaticals();
    }

    public function search($params) {
        unset($params['rating_id']);
        $this->staticals = $this->getStaticals($params);
    }

    public function getStaticals($params = []) {
        $name = $params['name'] ?? '';
        $from_date = $params['from_date'] ?? '';
        $to_date = $params['to_date'] ?? '';

        $users = $this->userRepos->filter([
            'name' => $name,
            'role_id' => 2,
        ]);

        $staticals = collect([]);

        foreach ($users as $key => $user) {
            $rating_staticals = $this->ratingStaticalRepos->filter([
                'user_id' => $user->id,
                'from_date' => $from_date,
                'to_date' => $to_date,
            ]);

            $row['name'] = $user->name;
            foreach ($this->ratings as $key => $rating) {
                $row['rating_count_'.$rating->id] = $rating_staticals->where('rating_id', $rating->id)->count();
            }

            $staticals->push($row);
        }

        return $staticals;
    }

    public function sortAndPaginateStaticals() {
        $staticals = $this->staticals;

        if (isset($this->sort) && $this->sort != '') {
            $sort = explode('_', $this->sort);
            $rating_id = $sort[0];
            $order = $sort[1];

            if ($order == 'asc') $staticals = $staticals->sortBy("rating_count_{$rating_id}");
            elseif ($order == 'desc') $staticals = $staticals->sortByDesc("rating_count_{$rating_id}");
        }

        return $staticals->paginate($this->paginate);
    }

    public function render()
    {
        $list_staticals = $this->sortAndPaginateStaticals();
        return view('admin.sections.rating-staticals.livewire.list-rating-statical')->with([
            'list_staticals' => $list_staticals,
        ]);
    }
}
