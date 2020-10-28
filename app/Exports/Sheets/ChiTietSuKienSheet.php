<?php
namespace App\Exports\Sheets;


use Modules\Report\Entities\Aereport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;
class ChiTietSuKienSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    protected $sukien;

    function __construct($sukien) {
           $this->sukien = $sukien;
    }
   

    /**
     * @return Builder
     */
    public function collection()
    {
        return $this->sukien->select('ten',
        DB::raw('DATE_FORMAT(ngay_bat_dau, "%d-%m-%Y") as ngay_bat_dau'),
        DB::raw('DATE_FORMAT(ngay_ket_thuc, "%d-%m-%Y") as ngay_ket_thuc'),
        'noi_dung','ket_qua')->first();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->sukien->ten;
    }

    public function headings(): array
    {
        return[
            'Tên sự kiện',
            'Ngày bắt đầu',
            'Ngày kết thúc',
            'Nội dung',
            'Kết quả',
        ];
    }
}