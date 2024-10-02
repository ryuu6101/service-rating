<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header header-elements-inline bg-secondary text-white">
                <h6 class="card-title">
                    <i class="icon-table2 mr-2"></i>
                    Thống kê đánh giá dịch vụ
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

                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-bordered table-dark table-sm align-middle text-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" rowspan="2">STT</th>
                                        <th scope="col" class="text-center" rowspan="2">Nhân viên</th>
                                        <th scope="col" class="text-center" colspan="{{ $ratings->count() }}">Đánh giá</th>
                                    </tr>
                                    <tr>
                                        @foreach ($ratings as $rating)
                                        <th scope="col" class="text-center">
                                            @if ($sort == $rating->id.'_asc')
                                            <span type="button" wire:click.prevent="$set('sort', '{{ $rating->id }}_desc')">
                                                {{ $rating->title }}
                                                <i class="icon-arrow-up5"></i>
                                            </span>
                                            @elseif ($sort == $rating->id.'_desc')
                                            <span type="button" wire:click.prevent="$set('sort', '{{ $rating->id }}_asc')">
                                                {{ $rating->title }}
                                                <i class="icon-arrow-down5"></i>
                                            </span>
                                            @else
                                            <span type="button" wire:click.prevent="$set('sort', '{{ $rating->id }}_desc')">
                                                {{ $rating->title }}
                                                <i class="icon-menu-open"></i>
                                            </span>
                                            @endif
                                        </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($list_staticals && count($list_staticals) > 0)
                                    @php($sn = ($list_staticals->perPage() * ($list_staticals->currentPage() - 1)) + 1)
                                    @foreach ($list_staticals as $key => $statical)
                    
                                    <tr>
                                        <td class="text-center">{{ $sn++ }}</td>
                                        <td class="text-left">{{ $statical['name'] }}</td>
                                        @foreach ($ratings as $rating)
                                        <td class="text-center">
                                            {{ $statical['rating_count_'.$rating->id] }}
                                        </td>
                                        @endforeach
                                    </tr>
                    
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="{{ 2 + $ratings->count() }}" class="text-center">
                                            (Không tìm thấy dữ liệu)
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        @include('admin.components.livewire-table-nav', ['collection' => $list_staticals])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>