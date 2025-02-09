<?php

namespace App\Exports\RatingExport;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RatingExport implements WithMultipleSheets
{
    use Exportable;

    protected $params;
    protected $ratings;
    protected $rating_staticals;

    public function __construct($ratings, $rating_staticals, $params)
    {
        $this->ratings = $ratings;
        $this->rating_staticals = $rating_staticals;
        $this->params = $params;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new RatingDetailSheet($this->rating_staticals, $this->params);
        $sheets[] = new RatingStaticalSheet($this->ratings, $this->rating_staticals);

        return $sheets;
    }
}
