<div>
    <div wire:ignore.self class="modal fade" id="addClientModal" tabindex="-1" aria-hidden="true">
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
                        Nhập thông tin khách hàng
                    </h5>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save" id="addClientForm">

                        <div class="row">
                            <div class="col-12 mb-2">
                                <input type="text" class="form-control" placeholder="Mã khách hàng" wire:model.blur="client_id">
                                @error('client_id')
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
                    <button type="submit" class="btn btn-primary" form="addClientForm" wire:loading.delay.longer.attr="disabled">
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
        $('#addClientModal').on('show.bs.modal', function(e) {
            @this.call('modalSetup');
        })

        $(document).on('close-add-client-modal', function() {
            $('#addClientModal').modal('hide');
        })
    })
</script>
@endpush