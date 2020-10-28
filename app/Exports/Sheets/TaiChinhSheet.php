<?php
namespace App\Exports\Sheets;

use Modules\Report\Entities\Aereport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use App\Models\TaiChinh;
class TaiChinhSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    protected $hocvien;
    protected $months;

    function __construct($hocvien,$months) {
           $this->hocvien = $hocvien;
           $this->months = $months;
    }
   

    /**
     * @return Builder
     */
    public function collection()
    {
        $id_tai_chinh = TaiChinh::where('tai_chinhs.thang',$this->months)->first();
        if($id_tai_chinh == null){
            return collect();
        }
        return DB::table('thu_chi_tai_chinhs')
        ->Leftjoin('tai_chinhs', 'thu_chi_tai_chinhs.tai_chinh_id', '=', 'tai_chinhs.id')
        ->Leftjoin('dien_giai_tai_chinhs', 'thu_chi_tai_chinhs.dien_giai_tai_chinh_id', '=', 'dien_giai_tai_chinhs.id')
        ->select('dien_giai_tai_chinhs.ten_dien_giai','thu_chi_tai_chinhs.thu','thu_chi_tai_chinhs.chi','tai_chinhs.tong_ngay_co_mat','tai_chinhs.tong_ngay_ngi')
        ->where('thu_chi_tai_chinhs.tai_chinh_id',$id_tai_chinh->id)
        ->where('tai_chinhs.hoc_vien_id', $this->hocvien->id)
        ->get();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Tháng '. $this->months;
    }

    public function headings(): array
    {
        return[
            'Tên diễn giải tài chính',
            'Thu',
            'Chi',
            'Tổng ngày có mặt',
            'Tổng ngày nghỉ',
        ];
    }
  
}