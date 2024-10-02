<div>
    <div class="card mb-0">
        {{-- <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#appreciateModal" >
            modal
        </button> --}}
        @if (auth()->user()->role->slug != 'nhan_vien')
        <div class="card-body">
            <div class="row mb-2">
                <div class="col">
                    <span class="text-center">
                        <i class="icon-warning mr-2"></i>
                        Vui lòng đăng nhập tài khoản Nhân viên để sử dụng chức năng này!
                    </span>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col text-center">
                    <a href="{{ route('logout') }}">Đăng nhập tài khoản khác</a>
                </div>
            </div>
        </div>
        @elseif ($serving)
        <div class="card-body">
            <div class="text-center mb-4">
                <h5 class="mb-0">Cảm ơn quý khách</h5>
                <span class="d-block text-muted">Xin hãy đánh giá dịch vụ của chúng tôi</span>
            </div>
    
            @foreach ($ratings as $rating)
            <div class="row mb-2">
                <div class="col">
                    <button type="button" class="btn btn-outline-secondary btn-block" data-toggle="modal" 
                    data-target="#appreciateModal" wire:click.prevent="rate({{ $rating->id }})">
                        {{ $rating->title }}
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="card-body" wire:poll.10s>
            <div class="row mb-2">
                <div class="col">
                    <span class="text-center">
                        <i class="icon-spinner2 spinner mr-2"></i>
                        Đang đợi dữ liệu khách hàng
                    </span>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div wire:ignore.self class="modal fade" id="appreciateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="text-center">Cảm ơn quý khách đã sử dụng dịch vụ của chúng tôi!</h3>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>