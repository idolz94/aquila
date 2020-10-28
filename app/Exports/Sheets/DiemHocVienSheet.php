<?php
namespace App\Exports\Sheets;


use Modules\Report\Entities\Aereport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\LyDoDiem;
use DB;
class DiemHocVienSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    protected $lophoc;
    protected $hocvien;

    function __construct($hocvien,$lophoc) {
           $this->hocvien = $hocvien;
           $this->lophoc = $lophoc;

    }
   

    /**
     * @return Builder
     */
    public function collection()
    {   
        $data = [];
        $lydodiem = LyDoDiem::all();
        $diems = DB::table('diem_mon_hocs')
            ->Leftjoin('lop_hocs', 'diem_mon_hocs.lop_hoc_id', '=', 'lop_hocs.id')
            ->Leftjoin('ly_do_diem', 'diem_mon_hocs.ly_do_id', '=', 'ly_do_diem.id')
            ->Leftjoin('hoc_viens', 'diem_mon_hocs.hoc_vien_id', '=', 'hoc_viens.id')
            ->select('hoc_viens.ten','ly_do_diem.ten as ly_do_diem','diem_mon_hocs.diem','diem_mon_hocs.created_at')
            ->where('lop_hocs.id',$this->lophoc->id)
            ->where('hoc_viens.id',$this->hocvien->id)
            ->get();
    
        foreach ($diems as $diem) {
            $data[] = ['ngay'=>date('d-m-Y', strtotime($diem->created_at)),'ly_do'=>$diem->ly_do_diem,'diem'=>$diem->diem];
        }
        return collect($data);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Lớp '.$this->lophoc->ma_lop_hoc;
    }

    public function headings(): array
    {
        return[
            'Ngày',
            'Lý do điểm',
            'Điểm',                      
        ];
    }
}