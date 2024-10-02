<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header header-elements-inline bg-secondary text-white">
                <h6 class="card-title">
                    <i class="icon-table2 mr-2"></i>
                    Danh sách tài khoản
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
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#crudUserModal">
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
                                        <th scope="col" class="text-center">Họ & Tên</th>
                                        <th scope="col" class="text-center">Chức vụ</th>
                                        <th scope="col" class="text-center">Kích hoạt</th>
                                        <th scope="col" class="text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users && count($users) > 0)
                                    @php($sn = ($users->perPage() * ($users->currentPage() - 1)) + 1)
                                    @foreach ($users as $key => $user)
                    
                                    <tr>
                                        <td class="text-center">{{ $sn++ }}</td>
                                        <td class="text-left">{{ $user->name }}</td>
                                        <td class="text-center">{{ $user->role->title }}</td>
                                        <td class="text-center">
                                            <a type="button" class="text-primary" wire:click.prevent="toggleUser({{ $user->id }})">
                                                <i class="icon-checkbox-{{ $user->is_actived ? 'checked2' : 'unchecked2' }}"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            {{-- <span type="button" class="badge badge-sm badge-primary" 
                                            data-toggle="modal" data-target="#userInfoModal" data-user-id="{{ $user->id }}">
                                                <i class="icon-eye"></i>
                                            </span> --}}
                                            <span type="button" class="badge badge-sm badge-success" 
                                            data-toggle="modal" data-target="#crudUserModal" data-user-id="{{ $user->id }}">
                                                <i class="icon-pencil5"></i>
                                            </span>
                                            <span type="button" class="badge badge-sm badge-danger" 
                                            data-toggle="modal" data-target="#crudUserModal" data-user-id="{{ -$user->id }}">
                                                <i class="icon-trash"></i>
                                            </span>
                                        </td>
                                    </tr>
                    
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">(Không tìm thấy tài khoản)</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        @include('admin.components.livewire-table-nav', ['collection' => $users])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>