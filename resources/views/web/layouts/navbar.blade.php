<div class="navbar navbar-expand-lg navbar-dark navbar-static">
    <div class="navbar-brand ml-2 ml-lg-0">
        <a href="{{ route('home.index') }}" class="d-inline-block">
            <img src="{{ asset('images/Logo-CNPT-Copy-removebg-preview.png') }}" alt="">
        </a>
    </div>

    <div class="d-flex justify-content-end align-items-center ml-auto">
        <ul class="navbar-nav flex-row">
            @if (auth()->user())
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="navbar-nav-link">
                    <i class="icon-switch2"></i>
                    {{-- <span class="d-none d-lg-inline-block ml-2"></span> --}}
                </a>
            </li>
            @else
            <li class="nav-item">
                <a href="{{ route('login.index') }}" class="navbar-nav-link">
                    <i class="icon-user-lock"></i>
                    <span class="d-none d-lg-inline-block ml-2">Đăng nhập</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</div>