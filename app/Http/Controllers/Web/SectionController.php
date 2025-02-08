<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Users\UserRepositoryInterface;

class SectionController extends Controller
{
    protected $userRepos;

    public function __construct(UserRepositoryInterface $userRepos) {
        $this->userRepos = $userRepos;
    }

    public function home() {
        return view('web.home.index');
    }

    public function survey($user_id) {
        if ($this->userRepos->find($user_id)->role->slug != 'nhan_vien') return abort(403);
        Auth::logout();
        return view('web.survey.index')->with(['user_id' => $user_id]);
    }
}
