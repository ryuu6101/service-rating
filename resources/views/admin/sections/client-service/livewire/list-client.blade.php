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
                <div class="row">
                    <div class="col">
                        <select class="form-select form-select-sm custom-select mb-3 w-auto" wire:model="paginate">
                            @for ($page = 5; $page <= 20; $page+=5)
                            <option value="{{ $page }}">{{ $page }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addClientModal">
                            <i class="icon-user-plus mr-2"></i>
                            Thêm mới
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-bordered table-dark table-sm align-middle text-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">STT</th>
                                        <th scope="col" class="text-center">Mã khách hàng</th>
                                        <th scope="col" class="text-center">Ngày tháng</th>
                                        <th scope="col" class="text-center">Đánh giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($rating_stasticals && count($rating_stasticals) > 0)
                                    @php($sn = ($rating_stasticals->perPage() * ($rating_stasticals->currentPage() - 1)) + 1)
                                    @foreach ($rating_stasticals as $key => $rating_stastical)
                    
                                    <tr>
                                        <td class="text-center">{{ $sn++ }}</td>
                                        <td class="text-center">{{ $rating_stastical->client_id }}</td>
                                        <td class="text-center">{{ $rating_stastical->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-center">{{ $rating_stastical->rating->title }}</td>
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
                        @include('admin.components.livewire-table-nav', ['collection' => $rating_stasticals])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>