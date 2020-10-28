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
class HocVienBoTronMonthExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
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
        $HocVienBoTronTrongThang = collect();
        foreach (HocVien::all() as $hocvien) {
            if($hocvien->vephep()->where('thang_ve',$month)->where('ly_do',1)->get()->count()>0){

                $data = [
                    'ma_hoc_vien'=>$hocvien->ma_hoc_vien,
                    'ten'=>$hocvien->ten,
                    'dia_chi'=>$hocvien->dia_chi,
                    'ngay_vao'=>$hocvien->ngay_vao,
                    'ngay_sinh'=>$hocvien->ngay_sinh,
                    'ngay_bo_tron'=>$hocvien->vephep->ngay_ve,
                    'ngay_quay_lai'=>$hocvien->vephep->ngay_quay_lai,
                    'tinh_trang'=>$hocvien->tinh_trang,
                    'ghi_chu'=>$hocvien->ghi_chu,
                ];
                $HocVienBoTronTrongThang->add($data);
            }
        }
        return $HocVienBoTronTrongThang;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Học Viên Trốn Trong Tháng '.date("m",strtotime($this->month));
    }

    public function headings(): array
    {
        return[
            'Mã học viên',
            'Tên học viên',
            'Địa chỉ',
            'Ngày vào trung tâm',
            'Ngày sinh',
            'Ngày bỏ trốn',
            'Ngày quay lại',
            'Tình trạng quay lại',
            'Ghi chú',
        ];
    }
   
}