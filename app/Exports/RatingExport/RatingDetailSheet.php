<?php

namespace App\Exports\RatingExport;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;

class RatingDetailSheet implements FromArray, WithTitle, WithEvents
{
    protected $params;
    protected $rating_staticals;

    public function __construct($rating_staticals, $params)
    {
        $this->rating_staticals = $rating_staticals;
        $this->params = $params;
    }

    public function array(): array
    {
        $rows = [];

        $rows[] = ['THỐNG KÊ CHI TIẾT'];
        $rows[] = ['TỪ NGÀY '.($this->params['from_date'] ?? '...').' ĐẾN NGÀY '.($this->params['to_date'] ?? '...')];
        $rows[] = ['STT', 'Mã khách hàng', 'Ngày tháng', 'Đánh giá'];

        $stt = 1;
        foreach ($this->rating_staticals as $key => $value) {
            $rows[] = [
                $stt++,
                $value->client_id,
                $value->created_at->format('d/m/Y H:i'),
                $value->rating->title ?? 'Không đánh giá',
            ];
        }

        return $rows;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Thống kê chi tiết';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $last_row = $sheet->getHighestRow();

                $sheet->mergeCells('A1:D1');
                $sheet->mergeCells('A2:D2');
                $sheet->getStyle('A1:D3')->getFont()->setBold(true);
                $sheet->getStyle('A1:D'.$last_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setWidth(20);
                $sheet->getColumnDimension('C')->setWidth(20);
                $sheet->getColumnDimension('D')->setWidth(20);
                $sheet->getStyle('A3:D'.$last_row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                $sheet->getStyle('A1');
            }
        ];
    }
}
