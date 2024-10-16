<div>
    <div wire:ignore.self class="modal fade" id="deleteBannerImageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Xác nhận
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <span>Bạn có muốn xóa ảnh?</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="delete" wire:loading.attr="disabled">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#deleteBannerImageModal').on('show.bs.modal', function(e) {
            var id = e.relatedTarget.getAttribute('data-banner-image-id') ?? 0;
            @this.call('modalSetup', id);
        })

        $(document).on('close-delete-banner-image-modal', function() {
            $('#deleteBannerImageModal').modal('hide');
        })
    })
</script>
@endpush