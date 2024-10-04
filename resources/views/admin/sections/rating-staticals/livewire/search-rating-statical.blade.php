<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header header-elements-inline bg-secondary text-white">
                <h6 class="card-title">
                    <i class="icon-search4 mr-2"></i>
                    Tìm kiếm
                </h6>
                <div class="header-elements"></div>
            </div>

            <div class="card-body">
                <form wire:submit.prevent="search">
                    <div class="row">
                        <div class="col-lg col-md-6 col-12">
                            <label>Nhân viên</label>
                            <input type="text" class="form-control" wire:model.blur="params.name">
                        </div>
                        <div class="col-lg col-md-6 col-12">
                            <label>Đánh giá</label>
                            <select class="form-control custom-select" wire:model="params.rating_id">
                                <option value="">Tất cả</option>
                                @foreach ($ratings as $key => $rating)
                                <option value="{{ $rating->id }}">{{ $rating->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg col-md-6 col-12">
                            <label>Từ ngày</label>
                            <input type="text" class="form-control datepicker" readonly id="from_date">
                        </div>
                        <div class="col-lg col-md-6 col-12">
                            <label>Đến ngày</label>
                            <input type="text" class="form-control datepicker" readonly id="to_date">
                        </div>
                    </div>
                    <div class="row justify-content-md-end justify-content-center mt-3">
                        <div class="col-md-auto col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon-search4 mr-2"></i>
                                Tìm kiếm
                            </button>
                            <button type="button" class="btn btn-secondary" wire:click.prevent="resetInput">
                                <i class="icon-reset mr-2"></i>
                                Làm mới
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.datepicker').daterangepicker({
            parentEl: '.content-inner',
            singleDatePicker: true,
            autoUpdateInput: false,
            showDropdowns: true,
            locale: {
                applyLabel: 'OK',
                cancelLabel: 'Xóa',
                daysOfWeek: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7','CN'],
                monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                firstDay: 1,
                format: 'DD/MM/YYYY',
            }
        }).on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        }).on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY'));
            let param = ev.currentTarget.id;
            @this.set(`params.${param}`, picker.startDate.format('DD/MM/YYYY'));
        });

        $(document).on('reset-datepicker', function(e) {
            $('.datepicker').daterangepicker().val('');
        })
    })
</script>
@endpush