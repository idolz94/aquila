<?php

namespace App\Services\Admin;

use App\Models\LopHoc;
use App\Services\Helpers\LopMonHocService;
use App\Services\Helpers\ImageService;
use Exception;
use DB;

class LopHocService extends BaseService
{
    public function model()
    {
        return LopHoc::class;
    }

    public function getListLopHoc($conditions) 
    {
        $data = $this->model->with('giaovien')->get();
            foreach ($data as $key => $value) {
                $checkHocVien[] = LopMonHocService::checkLopHocVien($value);
                $value['ngay_bat_dau'] = date("d-m-Y",strtotime($value['ngay_bat_dau'])); 
                $value['ngay_ket_thuc'] = date("d-m-Y",strtotime($value['ngay_ket_thuc'])); 
                $value['mon_hoc_id'] = $value->monhoc->mon_hoc;
            }
        return response()->json([
            'data' => $data
        ]);
    }

    public function store($request)
    { 

        return $this->create($request->all());
    }

    public function diem($hocvien)
    {
       foreach($hocvien as $hocvien){
            return $hocvien->pivot->diem;
            // $hocvien['note'] = $hocvien->pivot->note;
            
       }
    }

    public function diem_lydo(){
        return DB::table('diem_mon_hocs')
        ->Leftjoin('hoc_viens', 'diem_mon_hocs.hoc_vien_id', '=', 'hoc_viens.id')
        ->select('hoc_viens.*', 'diem_mon_hocs.diem','diem_mon_hocs.created_at')
        ->where('diem_mon_hocs.ly_do_id',$request->ly_do_id)
        ->where('diem_mon_hocs.lop_hoc_id',$request->lop_hoc_id)
        ->get();
    }
    public function diemHV($request){
        return DB::table('diem_mon_hocs')
        ->Leftjoin('hoc_viens', 'diem_mon_hocs.hoc_vien_id', '=', 'hoc_viens.id')
        ->select('hoc_viens.id', 'diem_mon_hocs.diem','diem_mon_hocs.ly_do_id','diem_mon_hocs.created_at')
        ->where('diem_mon_hocs.lop_hoc_id',$request['id'])
        ->where('diem_mon_hocs.hoc_vien_id',$request['hoc_vien_id'])
        ->get();
    }

    public function addImage($lophoc,$request){
        if (isset($request['images'])) {
            $typeImages = 'image_lophoc';
            foreach ($request['images'] as $image) {
                $fileName = ImageService::uploadFile($image, $typeImages, config('images.paths.' . $typeImages));
                $lophoc->anhlophoc()->create(['anh_lop_hoc' => $fileName]);
            }
            return true;
        }
        return false;
    }

    public function thoikhoabieu(array $data = []){
        $query = DB::table('thoi_khoa_bieus')
        ->Leftjoin('lop_hocs', 'thoi_khoa_bieus.lop_hoc_id', '=', 'lop_hocs.id')
        ->select('thoi_khoa_bieus.*', 'lop_hocs.ma_lop_hoc')
        ->where('lop_hocs.id',$data['id']);
        if(!isset($data['weekStartDate']) && !empty($data['weekStartDate'])){
            $query->whereBetween('thoi_khoa_bieuscó.created_at', [data['weekStartDate'], $data['weekStartDate']])->orderBy('ngay_thoi_khoa_bieus.ngay');
        }
        return $query->get();
        
    }
}
