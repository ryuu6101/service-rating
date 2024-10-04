<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header header-elements-inline bg-secondary text-white">
                <h6 class="card-title">
                    <i class="icon-table2 mr-2"></i>
                    Thống kê chi tiết
                </h6>
                <div class="header-elements"></div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <select class="form-select form-select-sm custom-select mb-3 w-auto" wire:model="paginate">
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
                                        <th scope="col" class="text-center">Nhân viên</th>
                                        <th scope="col" class="text-center">Mã khách hàng</th>
                                        <th scope="col" class="text-center">Ngày tháng</th>
                                        <th scope="col" class="text-center">Đánh giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($list_details && count($list_details) > 0)
                                    @php($sn = ($list_details->perPage() * ($list_details->currentPage() - 1)) + 1)
                                    @foreach ($list_details as $key => $list_detail)
                    
                                    <tr>
                                        <td class="text-center">{{ $sn++ }}</td>
                                        <td class="text-left">{{ $list_detail->user->name }}</td>
                                        <td class="text-center">{{ $list_detail->client_id }}</td>
                                        <td class="text-center">{{ $list_detail->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-center">{{ $list_detail->rating->title }}</td>
                                    </tr>
                    
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">(Không tìm thấy dữ liệu)</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        @include('admin.components.livewire-table-nav', ['collection' => $list_details])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>