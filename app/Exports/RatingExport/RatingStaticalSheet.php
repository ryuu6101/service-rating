<?php

namespace App\Exports\RatingExport;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;

class RatingStaticalSheet implements FromArray, WithTitle, WithEvents
{
    protected $ratings;
    protected $rating_staticals;

    public function __construct($ratings, $rating_staticals)
    {
        $this->ratings = $ratings;
        $this->rating_staticals = $rating_staticals;
    }

    public function array(): array
    {
        $rows = [];

        $rows[] = ['THỐNG KÊ CHUNG'];
        $rows[] = [''];
        $rows[] = ['Đánh giá', 'Số lượng'];

        foreach ($this->ratings as $key => $value) {
            $rows[] = [
                $value->title,
                $this->rating_staticals->where('rating_id', $value->id)->count(),
            ];
        }

        $rows[] = [
            'Không đánh giá',
            $this->rating_staticals->where('rating_id', 0)->count(),
        ];

        return $rows;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Thống kê chung';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $last_row = $sheet->getHighestRow();

                $sheet->mergeCells('A1:B1');
                $sheet->getStyle('A1:B3')->getFont()->setBold(true);
                // $sheet->getStyle('A1:B3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                // $sheet->getStyle('B4:B'.$last_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A1:B'.$last_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getColumnDimension('A')->setWidth(20);
                $sheet->getColumnDimension('B')->setWidth(12);
                $sheet->getStyle('A3:B'.$last_row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                $sheet->getStyle('A1');
            }
        ];
    }
}
