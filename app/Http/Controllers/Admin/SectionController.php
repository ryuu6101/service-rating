<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function users() {
        if (auth()->user()->role->slug != 'quan_ly') return abort(403);

        $menu = [
            'sidebar' => 'users',
            'breadcrumb' => 'Tài khoản',
        ];

        return view('admin.sections.users.index')->with($menu);
    }

    public function clientService() {
        if (auth()->user()->role->slug != 'nhan_vien') return abort(403);

        $menu = [
            'sidebar' => 'client-service',
            'breadcrumb' => 'Chăm sóc khách hàng',
        ];

        return view('admin.sections.client-service.index')->with($menu);
    }

    public function ratingStaticals() {
        if (auth()->user()->role->slug != 'quan_ly') return abort(403);

        $menu = [
            'sidebar' => 'rating-staticals',
            'breadcrumb' => 'Thống kê',
        ];

        return view('admin.sections.rating-staticals.index')->with($menu);
    }
}
