<div>
    <div wire:ignore.self class="modal fade" id="updateStaticalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" wire:loading wire:target="modalSetup">
                <div class="container-fluid py-5">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="spinner-border spinner-border-sm mr-2" role="status"></div>
                        <span class="ms-2">Vui lòng đợi</span>
                    </div>
                </div>
            </div>

            <div class="modal-content" wire:loading.class="d-none" wire:target="modalSetup">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Chỉnh sửa chi tiết
                    </h5>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update" id="updateStaticalForm">

                        <div class="row">
                            <div class="col-12 mb-2">
                                <label>Mã số đăng ký:</label>
                                <input type="text" class="form-control" wire:model.blur="client_id">
                                @error('client_id')
                                <span class="text-danger ml-1">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-12 mb-2">
                                <label>Ngày tháng:</label>
                                <input type="text" class="form-control datepicker created-at" wire:model.blur="created_at" readonly>
                                @error('created_at')
                                <span class="text-danger ml-1">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-12 mb-2">
                                <label>Đánh giá:</label>
                                <select class="form-control" wire:model.blur="rating_id">
                                    @foreach ($ratings as $rating)
                                    <option value="{{ $rating->id }}">{{ $rating->title }}</option>
                                    @endforeach
                                    <option value="0">Không đánh giá</option>
                                </select>
                                @error('rating_id')
                                <span class="text-danger ml-1">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:loading.delay.longer.attr="disabled">
                        Đóng
                    </button>
                    <button type="submit" class="btn btn-primary" form="updateStaticalForm" wire:loading.delay.longer.attr="disabled">
                        <span class="spinner-border spinner-border-sm mr-2" wire:loading.delay.longer></span>
                        <span wire:loading.delay.longer.remove><i class="icon-floppy-disk mr-2"></i></span>
                        Lưu
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#updateStaticalModal').on('show.bs.modal', function(e) {
            var id = e.relatedTarget.getAttribute('data-statical-id') ?? 0;
            @this.call('modalSetup', id);
        })

        $(document).on('close-update-statical-modal', function() {
            $('#updateStaticalModal').modal('hide');
        })

        $('.datepicker').daterangepicker({
            // parentEl: '.content-inner',
            autoUpdateInput: false,
            singleDatePicker: true,
            showDropdowns: true,
            timePicker: true,
            timePicker24Hour: true,
            drops: 'auto',
            locale: {
                daysOfWeek: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7','CN'],
                monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                firstDay: 1,
                format: 'DD/MM/YYYY h:mm',
            }
        },        
        function(start) {
            @this.created_at = start.format('DD/MM/YYYY h:mm');
        });

        $(document).on('set-datepicker-value', function() {
            var datetime = @this.created_at;
            var datepicker = $('.datepicker.created-at').data('daterangepicker');
            datepicker.setStartDate(datetime);
            datepicker.setEndDate(datetime);
        });
    })
</script>
@endpush