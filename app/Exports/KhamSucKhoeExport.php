<?php

namespace App\Exports;

use App\Models\KhamSucKhoe;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use DB;
class KhamSucKhoeExport implements FromCollection
{ 
    protected $hocvien;

    function __construct($hocvien) {
        $this->hocvien = $hocvien;
    }
    use Exportable;
 
   
/**
* @return \Illuminate\Support\Collection
*/
    public function collection()
    {
        return DB::table('kham_suc_khoes')
        ->Leftjoin('hoc_viens', 'kham_suc_khoes.hoc_vien_id', '=', 'hoc_viens.id')
        ->Leftjoin('suc_khoe_toan_than', 'kham_suc_khoes.id', '=', 'suc_khoe_toan_than.kham_suc_khoe_id')
        ->Leftjoin('suc_khoe_tam_than', 'kham_suc_khoes.id', '=', 'suc_khoe_tam_than.kham_suc_khoe_id')
        ->Leftjoin('suc_khoe_co_quan', 'kham_suc_khoes.id', '=', 'suc_khoe_co_quan.kham_suc_khoe_id')
        ->select(
        DB::raw('DATE_FORMAT(kham_suc_khoes.created_at, "%d-%m-%Y") as created_at'),
        'kham_suc_khoes.noi_dung','kham_suc_khoes.test_nhanh',
        'suc_khoe_toan_than.toan_than','suc_khoe_toan_than.mach','suc_khoe_toan_than.huyet_ap','suc_khoe_toan_than.nhiet_do','suc_khoe_toan_than.can_nang','suc_khoe_toan_than.nhip_tho',
        'suc_khoe_co_quan.ho_hap','suc_khoe_co_quan.tuan_hoan','suc_khoe_co_quan.tieu_hoa','suc_khoe_co_quan.tiet_nieu_sinh_duc','suc_khoe_co_quan.mat',
        'suc_khoe_tam_than.bieu_hien_chung','suc_khoe_tam_than.bieu_hien_khac',)
        ->where('kham_suc_khoes.hoc_vien_id',$this->hocvien->id)
        ->get();
    }

    public function title(): string
    {
        return $this->hocvien->ten;
    }


    public function headings(): array
    {
        return[
            'Ngày khám',
            'Nội dung',
            'Test nhanh',                      
            'Toàn thân',                      
            'Mạch',                      
            'Huyết áp',                      
            'Thân nhiệt',                      
            'Cân nặng',                      
            'Nhịp thở',                      
            'Hô hấp',                      
            'Tuần hoàn',                      
            'Tiêu hoá',                      
            'Tiết niệu sinh dục',                      
            'Mắt',                      
            'Biểu hiện chung',                      
            'Biểu hiện khác',                      
        ];
    }

}