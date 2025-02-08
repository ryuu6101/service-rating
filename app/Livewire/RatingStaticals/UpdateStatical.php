<?php

namespace App\Livewire\RatingStaticals;

use Carbon\Carbon;
use Livewire\Component;
use App\Livewire\RatingStaticals\ListDetail;
use App\Livewire\RatingStaticals\StaticalChart;
use App\Repositories\Ratings\RatingRepositoryInterface;
use App\Repositories\RatingStaticals\RatingStaticalRepositoryInterface;

class UpdateStatical extends Component
{
    protected $ratingRepos;
    protected $ratingStaticalRepos;

    public $rating_statical;
    public $ratings;

    public $client_id;
    public $created_at;
    public $rating_id;

    public function boot(
        RatingRepositoryInterface $ratingRepos,
        RatingStaticalRepositoryInterface $ratingStaticalRepos,
    ) {
        $this->ratingRepos = $ratingRepos;
        $this->ratingStaticalRepos = $ratingStaticalRepos;
    }

    public function rules() {
        return [
            'client_id' => ['required'],
            'created_at' => ['required'],
            'rating_id' => ['required'],
        ];
    }

    public function messages() {
        return [
            'client_id.required' => 'Vui lòng nhập mã số đăng ký.',
            'created_at.required' => 'Vui lòng nhập ngày tháng',
        ];
    }

    public function mount() {
        $this->ratings = $this->ratingRepos->getAll();
    }

    public function modalSetup($id) {
        $this->rating_statical = $this->ratingStaticalRepos->find(abs($id));
        $this->resetErrorBag();
        $this->getData();
    }

    public function getData() {
        $this->client_id = $this->rating_statical->client_id ?? '';
        $this->created_at = ($this->rating_statical->created_at ?? now())->format('d/m/Y H:i');
        $this->rating_id = $this->rating_statical->rating_id ?? $this->ratings->first()->id;
        $this->dispatch('set-datepicker-value');
    }

    public function update() {
        $this->resetErrorBag();
        $params = $this->validate();
        $params['created_at'] = Carbon::createFromFormat('d/m/Y H:i', $params['created_at'])->format('Y-m-d H:i');
        $this->rating_statical->update($params);
        $this->dispatch('updateChart')->to(StaticalChart::class);
        $this->dispatch('refresh')->to(ListDetail::class);
        $this->dispatch('close-update-statical-modal');
        $this->dispatch('show-message',
            type: 'success', 
            message: 'Đã cập nhật chi tiết',
        );
    }

    public function render()
    {
        return view('admin.sections.rating-staticals.livewire.update-rating-statical');
    }
}
