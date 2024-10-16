<?php

namespace App\Livewire\BannerImages;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\BannerImages\ListImage;
use App\Repositories\BannerImages\BannerImageRepositoryInterface;

class UpdateImage extends Component
{
    use WithFileUploads;

    protected $bannerImageRepos;

    public $banner_image;
    public $image_url;
    public $image_input;

    public function boot(BannerImageRepositoryInterface $bannerImageRepos) {
        $this->bannerImageRepos = $bannerImageRepos;
    }

    public function modalSetup($id) {
        $this->banner_image = $this->bannerImageRepos->find(abs($id));
        $this->reset('image_input');
        $this->image_url = $this->banner_image->image_url ?? 'images/placeholders/placeholder.png';
    }

    public function update() {
        if (!$this->image_input) return;
        $filename = time().'-'.$this->image_input->getClientOriginalName();
        $this->image_input->storeAs(path: 'public/images', name: $filename);
        $this->banner_image->update(['image_url' => 'storage/images/'.$filename]);
        $this->dispatch('refresh')->to(ListImage::class);
        $this->dispatch('close-update-banner-image-modal');
        $this->dispatch('show-message',
            type: 'success', 
            message: 'Đã cập nhật ảnh',
        );
    }

    public function render()
    {
        return view('admin.sections.banner-images.livewire.update-image');
    }
}
