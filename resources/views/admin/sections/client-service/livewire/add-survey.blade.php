<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header header-elements-inline bg-secondary text-white">
                <h6 class="card-title">
                    <i class="icon-vcard mr-2"></i>
                    Nhập thông tin khách hàng
                </h6>
                <div class="header-elements"></div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form wire:submit.prevent="openSurvey">
                            <div class="input-group d-flex justify-content-center">
                                <div>
                                    <input type="number" class="form-control hidden-arrow" 
                                    placeholder="Mã số đăng ký" wire:model.blur="new_client_id">
                                    @error('client_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div>
                                    @if (!$survey)
                                    <button type="submit" class="btn btn-success ml-2 px-4">Gửi</button>
                                    @else
                                    <button type="submit" class="btn btn-success ml-2 px-4">Gửi lại mã</button>
                                    <button type="button" class="btn btn-danger ml-2 px-4" wire:click.prevent="cancelSurvey">
                                        Xóa mã
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @if ($survey)
                        <div class="d-flex justify-content-center mt-2 text-muted" wire:poll.10s="check">
                            <span>Mã số đăng ký đang được hiển thị trên màn hình khách hàng: {{ $survey->client_id }}</span>
                        </div>
                        @elseif ($rating_result)
                        <div class="d-flex flex-column align-items-center justify-content-center mt-2" wire:poll.10s="check">
                            <span class="text-success">Mã số đăng ký: {{ $rating_result['client_id'] }}</span>
                            <span class="text-success">Kết quả đánh giá: {{ $rating_result['rating'] }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>