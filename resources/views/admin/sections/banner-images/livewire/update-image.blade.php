<div>
    <div wire:ignore.self class="modal fade" id="updateBannerImageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Thay ảnh
                    </h5>
                </div>

                <div class="modal-body" wire:loading wire:target="modalSetup">
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <img src="{{ asset('images/placeholders/placeholder.png') }}" class="img-fluid border shadow">
                        </div>
                    </div>
                </div>

                <div class="modal-body" wire:loading.remove wire:target="modalSetup">
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <input type="file" hidden wire:model="image_input" id="imageInput" accept=".png,.jpg">
                            <label for="imageInput" class="cursor-pointer">
                                @if ($image_input)
                                <img src="{{ asset($image_input->temporaryUrl()) }}" alt="" class="img-fluid border shadow">
                                @elseif ($image_url)
                                <img src="{{ asset($image_url) }}" alt="" class="img-fluid border shadow">
                                @else
                                <img src="{{ asset('images/placeholders/placeholder.png') }}" class="img-fluid border shadow">
                                @endif
                            </label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="update" @disabled(!$image_input)>
                        <span><i class="icon-floppy-disk mr-2"></i></span>
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
        $('#updateBannerImageModal').on('show.bs.modal', function(e) {
            var id = e.relatedTarget.getAttribute('data-banner-image-id') ?? 0;
            @this.call('modalSetup', id);
        })

        $(document).on('close-update-banner-image-modal', function() {
            $('#updateBannerImageModal').modal('hide');
        })
    })
</script>
@endpush