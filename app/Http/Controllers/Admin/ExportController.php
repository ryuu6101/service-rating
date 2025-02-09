<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\RatingExport\RatingExport;
use App\Repositories\Ratings\RatingRepositoryInterface;
use App\Repositories\RatingStaticals\RatingStaticalRepositoryInterface;

class ExportController extends Controller
{
    protected $ratingRepos;
    protected $ratingStaticalRepos;

    public function __construct(
        RatingRepositoryInterface $ratingRepos,
        RatingStaticalRepositoryInterface $ratingStaticalRepos,
    ) {
        $this->ratingRepos = $ratingRepos;
        $this->ratingStaticalRepos = $ratingStaticalRepos;
    }

    public function ratingExport(Request $request) {
        $params = $request->params;
        $ratings = $this->ratingRepos->getAll();
        $rating_staticals = $this->ratingStaticalRepos->filter($params);

        $rating_export = new RatingExport($ratings, $rating_staticals, $params);

        return $rating_export->download('thong_ke.xlsx');
    }
}
