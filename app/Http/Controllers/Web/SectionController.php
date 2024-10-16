<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function home() {
        return view('web.home.index');
    }

    public function survey($user_id) {
        Auth::logout();
        return view('web.survey.index')->with(['user_id' => $user_id]);
    }
}
