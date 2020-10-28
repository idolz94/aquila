<?php

namespace App\Exports;

use App\Models\GiaoVien;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Modules\Report\Entities\Aereport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;

class GiaoVienExport  implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{ 
    use Exportable;
   
/**
* @return \Illuminate\Support\Collection
*/
    public function collection()
    {
        return DB::table('giao_viens')
        ->Leftjoin('he_phais', 'giao_viens.he_phai_id', '=', 'he_phais.id')
        ->Leftjoin('chuc_vus', 'giao_viens.chuc_vu_id', '=', 'chuc_vus.id')
        ->select('giao_viens.ten','giao_viens.email','giao_viens.ngay_sinh','giao_viens.so_dien_thoai','giao_viens.doi_tac','he_phais.ten as he_phai','chuc_vus.ten as chuc_vu')
        ->get();
    }

    public function title(): string
    {
        return "Danh Sách Giáo Viên";
    }

    public function headings(): array
    {
        return[
            'Tên',
            'Email',
            'Ngày Sinh',
            'Số điện thoại',
            'Đối tác',
            'Hệ phái',
            'Chức vụ',
        ];
    }

}