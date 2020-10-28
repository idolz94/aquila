<?php
namespace App\Exports\Sheets;


use Modules\Report\Entities\Aereport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;
class SuKienHocVienSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
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
        return DB::table('su_kien_hoc_vien')
        ->Leftjoin('su_kiens', 'su_kien_hoc_vien.su_kien_id', '=', 'su_kiens.id')
        ->Leftjoin('hoc_viens', 'su_kien_hoc_vien.hoc_vien_id', '=', 'hoc_viens.id')
        ->select('hoc_viens.ma_hoc_vien','hoc_viens.ten','hoc_viens.dia_chi',
        DB::raw('DATE_FORMAT(su_kien_hoc_vien.created_at, "%d-%m-%Y") as created_at'),
        'hoc_viens.ngay_sinh','hoc_viens.gioi_tinh')
        ->where('su_kien_hoc_vien.su_kien_id',$this->sukien->id)
        ->get();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Danh sách học viên';
    }

    public function headings(): array
    {
        return[
            'Mã học viên',
            'Tên học viên',
            'Địa chỉ',
            'Ngày vào sự kiện',
            'Ngày sinh',
            'Giới tính',                     
        ];
    }
}