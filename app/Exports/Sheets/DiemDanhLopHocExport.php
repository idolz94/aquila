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
class DiemDanhLopHocExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    protected $lophoc;

    function __construct($lophoc) {
           $this->lophoc = $lophoc;
    }
   

    /**
     * @return Builder
     */
    public function collection()
    {
        $data = [];
        $lydodiem = LyDoDiem::all();
        $hocviens = $this->lophoc->hocvien;
        $thoikhoabieus = DB::table('thoi_khoa_bieus')
        ->Leftjoin('lop_hocs', 'thoi_khoa_bieus.lop_hoc_id', '=', 'lop_hocs.id')
        ->select('thoi_khoa_bieus.*', 'lop_hocs.ma_lop_hoc')
        ->where('lop_hocs.id',$this->lophoc->id)
        ->get();
        $data = [];
        foreach($hocviens as $key => $hocvien ){
            $diemdanh =  $hocvien->diemdanh()->wherePivot('lop_hoc_id',$this->lophoc->id)->get();
            $data[$key] = ['ten'=>$hocvien->ten];
            foreach($thoikhoabieus as $thoikhoabieu) {
                array_push($data[$key],$thoikhoabieu->ngay);
                foreach ($diemdanh as $value) {
                    if($value->pivot->ngay == $thoikhoabieu->ngay){
                        if($value->pivot->ca_hoc == 0){
                            $diemdanh_hv =  'Sáng điểm danh';
                        }
                        if($value->pivot->ca_hoc == 1){
                            $diemdanh_hv =  'Chiều điểm danh';
                        }
                        array_push($data[$key],$diemdanh_hv);
                    }
                   
                }
            //     if($diem->hoc_vien_id == $hocvien->id){
            //     //    foreach ($lydodiem as $lydo) {
            //     //       if($lydo->id == $diem->ly_do_id){
            //     //         $diem_hv = [$diem->diem,$lydo->ten];
            //     //       }
            //     //    }
            //     $diem_hv = $diem->ly_do_diem . ' - '. $diem->diem;
            //         array_push($data[$key],$diem_hv);
            //     }
            }
        }
        return collect($data);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Điểm'.$this->lophoc->ma_lop_hoc;
    }

    public function headings(): array
    {
        return
        [
            'Tên học viên',
            'Ngày',
        ];
    }
}