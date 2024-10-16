<?php

namespace App\Livewire\BannerImages;

use Livewire\Component;
use App\Repositories\BannerImages\BannerImageRepositoryInterface;

class ListImage extends Component
{
    protected $bannerImageRepos;

    protected $listeners = ['refresh' => '$refresh'];

    public function boot(BannerImageRepositoryInterface $bannerImageRepos) {
        $this->bannerImageRepos = $bannerImageRepos;
    }

    public function render()
    {
        $images = $this->bannerImageRepos->getAll();
        return view('admin.sections.banner-images.livewire.list-image')->with(['images' => $images]);
    }
}
