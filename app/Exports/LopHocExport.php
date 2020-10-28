<?php

namespace App\Exports;
use App\Models\SuKien;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\NhomSheetExport;
use Modules\Report\Entities\Aereport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;

class LopHocExport  implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{ 
    use Exportable;
/**
* @return \Illuminate\Support\Collection
*/
    public function collection()
    {
        return  DB::table('lop_hocs')
        ->Leftjoin('giao_viens', 'lop_hocs.giao_vien_id', '=', 'giao_viens.id')
        ->Leftjoin('mon_hocs', 'lop_hocs.mon_hoc_id', '=', 'mon_hocs.id')
        ->select('lop_hocs.ma_lop_hoc','mon_hocs.mon_hoc','giao_viens.ten',
        DB::raw('DATE_FORMAT(lop_hocs.ngay_bat_dau, "%d-%m-%Y") as ngay_bat_dau'),
        DB::raw('DATE_FORMAT(lop_hocs.ngay_ket_thuc, "%d-%m-%Y") as ngay_ket_thuc'))
        ->get();
    }

    public function title(): string
    {
        return 'danh sách lớp học';
    }

    public function headings(): array
    {
        return[
            'Mã lớp học',
            'Môn học',
            'Giáo viên',
            'Ngày bắt đầu',
            'Ngày kết thúc',
        ];
    }

}