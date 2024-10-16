@push('styles')
<style>
    .banner-images-container {
        background-image: url("{{ asset('images/HD Desktop Blue.jpg') }}");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
@endpush

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header header-elements-inline bg-secondary text-white">
                <h6 class="card-title">
                    <i class="icon-table2 mr-2"></i>
                    Chỉnh sửa ảnh banner
                </h6>
                <div class="header-elements"></div>
            </div>

            <div class="card-body banner-images-container">

                <div class="row">
                    @foreach ($images as $image)
                    <div class="{{ $image->position == 'center' ? 'col-8' : 'col-2' }} border cursor-pointer position-relative" >
                        @if ($image->image_url)
                        <a href="#!" class="badge badge-danger position-absolute top-0 right-0 rounded-0 border-left border-bottom"
                        data-toggle="modal" data-target="#deleteBannerImageModal" data-banner-image-id="{{ $image->id }}">
                            <i class="icon-trash"></i>
                        </a>
                        @endif
                        <div class="{{ $image->position != 'center' ? 'p-4' : '' }} container-fluid h-100"
                        data-toggle="modal" data-target="#updateBannerImageModal" data-banner-image-id="{{ $image->id }}">
                            <img src="{{ asset($image->image_url ?? 'images/placeholders/trans_placeholder.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>