<?php
namespace App\Exports\Sheets;

use Modules\Report\Entities\Aereport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use App\Models\HocVien;
class HocVienNewMonthExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    protected $month;

    function __construct($month) {
           $this->month = $month;
    }
   

    /**
     * @return Builder
     */
    public function collection()
    {
        $month = date("m",strtotime($this->month));
        $year = date("Y",strtotime($this->month));
        return DB::table('hoc_viens')->whereMonth('ngay_vao', $month)->whereYear('ngay_vao', $year)->select('ma_hoc_vien','ten','dia_chi','ngay_vao','ngay_sinh','gioi_tinh')->get();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Học Viên Vào Trong Tháng '.date("m",strtotime($this->month));
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