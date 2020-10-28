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

class HocVienExport  implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{ 
    use Exportable;
  
/**
* @return \Illuminate\Support\Collection
*/
    public function collection()
    {
 
      return DB::table('hoc_viens')
      ->Leftjoin('nguoi_bao_hos', 'hoc_viens.nguoi_bao_ho_id', '=', 'nguoi_bao_hos.id')
      ->select('hoc_viens.ma_hoc_vien','hoc_viens.ten','nguoi_bao_hos.ten as ten_bao_ho','nguoi_bao_hos.so_dien_thoai','nguoi_bao_hos.quan_he_hoc_vien','hoc_viens.dia_chi',
      DB::raw('DATE_FORMAT(hoc_viens.ngay_sinh, "%d-%m-%Y") as ngay_sinh'),
      'hoc_viens.gioi_tinh','hoc_viens.so_cmnd',
      DB::raw('DATE_FORMAT(hoc_viens.ngay_vao, "%d-%m-%Y") as ngay_vao'))
      ->get();
    }

    public function title(): string
    {
        return 'Danh sách học viên';
    }

    public function headings(): array
    {
        return[
            'Mã học viên',
            'Tên học viên',
            'Tên người bảo hộ',
            'Số điện thoại',
            'Quan hệ với học viên',
            'Địa chỉ',
            'Ngày sinh',
            'Giới tính',
            'Cmnd',
            'Ngày vào trung tâm',
        ];
    }

}