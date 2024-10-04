<div>
    <div class="card mb-0">
        {{-- <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#appreciateModal" >
            modal
        </button> --}}
        @if (!auth()->user() || auth()->user()->role->slug != 'nhan_vien')
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
                    @if (auth()->user())
                    <a href="{{ route('logout') }}">Đăng nhập tài khoản khác</a>
                    @else
                    <a href="{{ route('login.index') }}">Đăng nhập</a>
                    @endif
                </div>
            </div>
        </div>
        @else
        <div class="card-body">
            <div class="row mb-2">
                <div class="col">
                    <form wire:submit.prevent="openSurvey" id="clientInfoForm">
                        <input type="text" class="form-control" placeholder="Nhập mã khách hàng" wire:model.blur="client_id">
                        @error('client_id')
                        <span class="text-danger ml-1">{{$message}}</span>
                        @enderror
                    </form>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <button type="submit" form="clientInfoForm" class="btn btn-success btn-block">Gửi</button>
                </div>
            </div>
            {{-- <div class="row mb-2">
                <div class="col">
                    <a href="{{ route('survey.index') }}" type="button" class="btn btn-primary btn-block">Đến trang đánh giá</a>
                </div>
            </div> --}}
        </div>
        @endif
    </div>
</div>