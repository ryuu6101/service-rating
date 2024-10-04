<?php

namespace App\Livewire\RatingStaticals;

use App\Models\Rating;
use Livewire\Component;
use App\Livewire\RatingStaticals\ListDetail;
use App\Livewire\RatingStaticals\ListStatical;

class SearchStatical extends Component
{
    public $params = [];
    public $ratings;

    public function mount() {
        $this->ratings = Rating::all();
    }

    public function search() {
        $this->dispatch('search', params: $this->params)->to(ListStatical::class);
        $this->dispatch('search', params: $this->params)->to(ListDetail::class);
    }

    public function resetInput() {
        $this->reset('params');
        $this->dispatch('reset-datepicker');
    }

    public function render()
    {
        return view('admin.sections.rating-staticals.livewire.search-rating-statical');
    }
}
