<?php

namespace App\Livewire\BannerImages;

use Livewire\Component;
use App\Livewire\BannerImages\ListImage;
use App\Repositories\BannerImages\BannerImageRepositoryInterface;

class DeleteImage extends Component
{
    protected $bannerImageRepos;

    public $banner_image;

    public function boot(BannerImageRepositoryInterface $bannerImageRepos) {
        $this->bannerImageRepos = $bannerImageRepos;
    }

    public function modalSetup($id) {
        $this->banner_image = $this->bannerImageRepos->find(abs($id));
    }

    public function delete() {
        $this->banner_image->update(['image_url' => null]);
        $this->dispatch('refresh')->to(ListImage::class);
        $this->dispatch('close-delete-banner-image-modal');
        $this->dispatch('show-message',
            type: 'success', 
            message: 'Đã xóa ảnh',
        );
    }

    public function render()
    {
        return view('admin.sections.banner-images.livewire.delete-image');
    }
}
