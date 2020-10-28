<?php

namespace App\Exports;

use App\Models\Nhom;
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

class NhomHocVienExport  implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{ 
    use Exportable;
    protected $id;
    protected $nhom;
    function __construct($id) {
            $this->id = $id;
            $this->nhom =  Nhom::find($this->id);
    }
   
/**
* @return \Illuminate\Support\Collection
*/
    public function collection()
    {
        return  DB::table('nhom_hoc_vien')
        ->Leftjoin('hoc_viens', 'nhom_hoc_vien.hoc_vien_id', '=', 'hoc_viens.id')
        ->Leftjoin('nhoms', 'nhom_hoc_vien.nhom_id', '=', 'nhoms.id')
        ->select('hoc_viens.ma_hoc_vien','hoc_viens.ten','hoc_viens.dia_chi','hoc_viens.ngay_sinh','hoc_viens.gioi_tinh',
        DB::raw('DATE_FORMAT(nhom_hoc_vien.created_at, "%d-%m-%Y") as ngay_vao_nhom'))
        ->get();
    }

    public function title(): string
    {
        return 'Lop '.$this->nhom->ten;
    }

    public function headings(): array
    {
        return[
            'Mã học viên',
            'Tên học viên',
            'Địa chỉ',
            'Ngày sinh',
            'Giới tính',
            'Ngày vào nhóm',
        ];
    }

}