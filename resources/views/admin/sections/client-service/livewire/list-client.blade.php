<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header header-elements-inline bg-secondary text-white">
                <h6 class="card-title">
                    <i class="icon-table2 mr-2"></i>
                    Danh sách khách hàng
                </h6>
                <div class="header-elements"></div>
            </div>

            <div class="card-body">
                <div class="row justify-content-between mb-3">
                    <div class="col">
                        <div class="input-group">
                            <div class="mr-2">
                                <input type="number" class="form-control hidden-arrow" 
                                placeholder="Mã số đăng ký" wire:model.live="params.client_id">
                            </div>
                            <div class="mr-2">
                                <select class="form-select custom-select" wire:model.live="params.rating_id">
                                    <option value="">Tất cả đánh giá</option>
                                    @foreach ($ratings as $rating)
                                    <option value="{{ $rating->id }}">{{ $rating->title }}</option>
                                    @endforeach
                                    <option value="0">Không đánh giá</option>
                                </select>
                            </div>
                            <div class="mr-2">
                                <input type="text" class="form-control mr-2 daterange-picker cursor-pointer" 
                                wire:model="daterange" readonly placeholder="Thời gian">
                            </div>
                            {{-- <div class="mr-2">
                                <button type="button" class="btn btn-warning" wire:click.prevent="resetInput">
                                    <i class="icon-loop3"></i>
                                </button>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <select class="form-select custom-select w-auto float-right" wire:model="paginate">
                            @for ($page = 5; $page <= 20; $page+=5)
                            <option value="{{ $page }}">{{ $page }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-bordered table-dark table-sm align-middle text-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">STT</th>
                                        <th scope="col" class="text-center">Mã số đăng ký</th>
                                        <th scope="col" class="text-center">Đánh giá</th>
                                        <th scope="col" class="text-center">Ngày tháng</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if ($rating_staticals && count($rating_staticals) > 0)
                                    @php($sn = ($rating_staticals->perPage() * ($rating_staticals->currentPage() - 1)) + 1)
                                    @foreach ($rating_staticals as $key => $rating_statical)
                    
                                    <tr>
                                        <td class="text-center">{{ $sn++ }}</td>
                                        <td class="text-center">{{ $rating_statical->client_id }}</td>
                                        <td class="text-center position-relative">
                                            @if ($rating_statical->rating_id > 0)
                                            <span class="badge badge-info">{{ $rating_statical->rating->title }}</span>
                                            @else
                                            <span class="badge badge-secondary">Không đánh giá</span>
                                            @endif
                                            @if ($rating_statical->recent)
                                            <span class="badge badge-success position-absolute right-0 mr-2">new</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $rating_statical->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                    
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="4" class="text-center">(Không tìm thấy dữ liệu)</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        @include('admin.components.livewire-table-nav', ['collection' => $rating_staticals])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        let this_year = (new Date()).getFullYear();

        $('.daterange-picker').daterangepicker({
            parentEl: '.content-inner',
            autoUpdateInput: false,
            showDropdowns: true,
            drops: 'auto',
            ranges: {
                'Hôm nay': [moment(), moment()],
                'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '1 tuần trước': [moment().subtract(6, 'days'), moment()],
                '1 tháng trước': [moment().subtract(29, 'days'), moment()],
                // 'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                // 'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'Quý 1': [`01/01/${this_year}`, `31/03/${this_year}`],
                'Quý 2': [`01/04/${this_year}`, `30/06/${this_year}`],
                'Quý 3': [`01/07/${this_year}`, `30/09/${this_year}`],
                'Quý 4': [`01/10/${this_year}`, `31/12/${this_year}`],
            },
            locale: {
                applyLabel: 'OK',
                cancelLabel: 'Xóa',
                customRangeLabel: 'Tùy chỉnh',
                daysOfWeek: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7','CN'],
                monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                firstDay: 1,
                format: 'DD/MM/YYYY',
            }
        }).on('cancel.daterangepicker', function(ev, picker) {
            // $(this).val('');
            @this.set('daterange', '');
            @this.set('params.from_date', '');
            @this.set('params.to_date', '');
        }).on('apply.daterangepicker', function(ev, picker) {
            // $(this).val(picker.startDate.format('DD/MM/YYYY'));
            var start_date = picker.startDate.format('DD/MM/YYYY');
            var end_date = picker.endDate.format('DD/MM/YYYY');
            @this.set('daterange', `${start_date} - ${end_date}`);
            @this.set('params.from_date', start_date);
            @this.set('params.to_date', end_date);
        });
    });
</script>
@endpush