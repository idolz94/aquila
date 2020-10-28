<?php
namespace App\Exports\Sheets;

use Modules\Report\Entities\Aereport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\HocVien;
use DB;
class HocVienExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{

    /**
     * @return Builder
     */
    public function collection()
    {
        return DB::table('hoc_viens')->select('ma_hoc_vien','ten','dia_chi','ngay_vao','ngay_sinh','gioi_tinh')->get();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Tổng Học Viên';
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