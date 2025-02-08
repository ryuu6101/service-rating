<div>
    <div wire:ignore.self class="modal fade" id="deleteStaticalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Xác nhận
                    </h5>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="delete" id="deleteStaticalForm">
                        <div class="row">
                            <div class="col">
                                <span>Bạn có chắc muốn xóa?</span>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" form="deleteStaticalForm" wire:loading.attr="disabled">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#deleteStaticalModal').on('show.bs.modal', function(e) {
            var id = e.relatedTarget.getAttribute('data-statical-id') ?? 0;
            @this.call('modalSetup', id);
        })
        
        $(document).on('close-delete-statical-modal', function() {
            $('#deleteStaticalModal').modal('hide');
        })
    })
</script>
@endpush