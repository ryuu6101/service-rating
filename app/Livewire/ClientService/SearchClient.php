<?php

namespace App\Livewire\ClientService;

use App\Models\Rating;
use Livewire\Component;
use App\Livewire\ClientService\ListClient;

class SearchClient extends Component
{
    public $ratings;
    public $params = [];

    public function mount() {
        $this->ratings = Rating::all();
    }

    public function search() {
        $this->dispatch('search', params: $this->params)->to(ListClient::class);
    }

    public function resetInput() {
        $this->reset('params');
        $this->dispatch('reset-datepicker');
    }

    public function render()
    {
        return view('admin.sections.client-service.livewire.search-client');
    }
}
