@inject('bannerImageRepos', 'App\Repositories\BannerImages\BannerImageRepositoryInterface')

<div class="">
    <div class="row my-3 overflow-hidden" style="max-height:10rem">
        <div class="col-2 p-4">
            {{-- <img src="{{ asset('images/Logo-CNPT-Copy-removebg-preview.png') }}" alt="" class="img-fluid"> --}}
            @if ($left_image = $bannerImageRepos->find(1))
            <img src="{{ asset($left_image->image_url) }}" alt="" class="img-fluid">
            @endif
        </div>
        <div class="col-8">
            {{-- <img src="{{ asset('images/image.png') }}" alt="" class="img-fluid"> --}}
            @if ($left_image = $bannerImageRepos->find(2))
            <img src="{{ asset($left_image->image_url) }}" alt="" class="img-fluid">
            @endif
        </div>
        <div class="col-2 p-4">
            @if ($left_image = $bannerImageRepos->find(3))
            <img src="{{ asset($left_image->image_url) }}" alt="" class="img-fluid">
            @endif
        </div>
    </div>
</div>