<?php

namespace App\Livewire\RatingStaticals;

use Livewire\Component;
use App\Livewire\RatingStaticals\ListDetail;
use App\Livewire\RatingStaticals\StaticalChart;
use App\Repositories\RatingStaticals\RatingStaticalRepositoryInterface;

class DeleteStatical extends Component
{
    protected $ratingStaticalRepos;

    public $rating_statical;

    public function boot(
        RatingStaticalRepositoryInterface $ratingStaticalRepos,
    ) {
        $this->ratingStaticalRepos = $ratingStaticalRepos;
    }

    public function modalSetup($id) {
        $this->rating_statical = $this->ratingStaticalRepos->find(abs($id));
    }

    public function delete() {
        $this->rating_statical->delete();
        $this->reset('rating_statical');
        $this->dispatch('updateChart')->to(StaticalChart::class);
        $this->dispatch('refresh')->to(ListDetail::class);
        $this->dispatch('close-delete-statical-modal');
        $this->dispatch('show-message',
            type: 'success', 
            message: 'Đã xóa chi tiết',
        );
    }

    public function render()
    {
        return view('admin.sections.rating-staticals.livewire.delete-rating-statical');
    }
}
