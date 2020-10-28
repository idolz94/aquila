<?php
namespace App\Exports\Sheets;


use Modules\Report\Entities\Aereport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;
class PhongSheetExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    protected $phong;

    function __construct($phong) {
           $this->phong = $phong;
    }
   

    /**
     * @return Builder
     */
    public function collection()
    {
        return $this->phong->hocvien()->select('ma_hoc_vien','ten','dia_chi','ngay_vao','ngay_sinh','gioi_tinh')->wherePivot('type',1)->get();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->phong->ten_phong;
    }

    public function headings(): array
    {
        return[
            'Mã học viên',
            'Tên học viên',
            'Địa chỉ',
            'Ngày vào trung tâm',
            'Ngày sinh',
            'Giới tính',                     
        ];
    }
}