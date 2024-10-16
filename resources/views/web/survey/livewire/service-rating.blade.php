@push('styles')
<style>
    .banner-title {
        --color: rgba(79, 229, 255, 0.6);
        background: var(--color);
        box-shadow: -20px 0 0 0 var(--color), 20px 0 0 0 var(--color);
    }

    .banner-title h1 {
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-style: italic;
        font-weight: bold;
    }
</style>
@endpush

<div class="container-fluid">
    @if ($survey || $update_statical)

    <div class="text-center banner-title">
        <h1>
            Xin chào quý khách <br>
            Mời quý khách đánh giá dịch vụ của chúng tôi.
        </h1>
    </div>
    <div class="text-center">
        <h5 class="">Mã số đăng ký: {{ $survey->client_id ?? $update_statical->client_id }}</h5>
    </div>
    <div class="row justify-content-center align-items-center flex-column flex-md-row" wire:poll.10s>
        @foreach ($ratings as $rating)
        <div class="col-xl-2 col-md-3 col-sm-5 col-7">
            @if ($survey)
            <div class="card bg-primary cursor-pointer" wire:click.prevent="rate({{ $rating->id }})">
            @elseif ($update_statical)
            <div class="card bg-primary cursor-pointer" wire:click.prevent="update({{ $rating->id }})">
            @endif
                <img src="{{ asset($rating->image_url) }}" alt="{{ $rating->slug }}" class="card-img-top p-4 bg-white">
                <div class="card-footer bg-primary text-white text-center pt-3">
                    <h4><strong>{{ $rating->title }}</strong></h4>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @elseif ($rating_statical)

    <div class="text-center banner-title py-2">
        <h1>
            Cảm ơn quý khách đã để lại ý kiến.
        </h1>
    </div>
    <div class="text-center">
        <h4 class="">Mã số đăng ký: {{ $rating_statical->client_id }}</h4>
    </div>
    <div class="row justify-content-center" wire:poll.10s>
        <div class="col-auto">
            <div class="card px-4">
                <div class="card-body px-3">
                    <div class="mb-2 text-center">
                        <span>Kết quả đánh giá: {{ $rating_statical->rating->title }}</span>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-block" wire:click.prevent="reselect">
                        Đánh giá lại
                    </button>
                </div>
            </div>
        </div>
    </div>

    @else

    <div class="row mb-2 mt-4 justify-content-center">
        <div class="col-auto">
            <div class="card mb-0 px-3" wire:poll.10s>
                <div class="card-body text-center">
                    <span class="text-center">
                        <i class="icon-spinner2 spinner mr-2"></i>
                        Đang đợi dữ liệu khách hàng
                    </span>
                </div>
            </div>
        </div>
    </div>

    @endif
</div>