<?php

namespace App\Http\Controllers\NguoiNha;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\HocVienService;
use App\Services\Admin\LopHocService;
use App\Services\Admin\KhamSucKhoeService;
use DB;
use App\Models\LyDoDiem;
use App\Models\LopHoc;
use App\Models\TaiChinh;


class HocVienController extends Controller
{
    public function __construct(HocVienService $hocvienService,KhamSucKhoeService $khamsuckhoeService,LopHocService $lophocService)
    {
        $this->hocvienService = $hocvienService;
        $this->khamsuckhoeService = $khamsuckhoeService;
        $this->lophocService = $lophocService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nguoinha.hocvien.index');
    }


    public function diemDanh()
    {
        $nguoibaoho = Auth::guard('nguoibaoho')->user();
        $hocvien = $nguoibaoho->hocvien;
        $lophocs = $hocvien->lophoc;
        return view('nguoinha.hocvien.diemdanh',compact('lophocs','hocvien'));
    }
    public function sucKhoe()
    {
        $nguoibaoho = Auth::guard('nguoibaoho')->user();
        $hocvien = $nguoibaoho->hocvien->id;
        $khamsuckhoes = DB::table('kham_suc_khoes')->where('hoc_vien_id',$hocvien)->get();
        $khamsuckhoe = '';
        if(count($khamsuckhoes) > 0){
            $khamsuckhoe = $this->khamsuckhoeService->show($khamsuckhoes[ $khamsuckhoes->count()-1]->id);
        }
        return view('nguoinha.hocvien.suckhoe',compact('khamsuckhoes','khamsuckhoe'));
    }

    public function sucKhoeDetail(Request $request){
         $khamsuckhoes = $this->khamsuckhoeService->show($request->id);
        return response()->json($khamsuckhoes);
    }

    public function hocPhi()
    {
        $nguoibaoho = Auth::guard('nguoibaoho')->user();
        $hocvien = $nguoibaoho->hocvien;
        $hv_taichinh = $hocvien->taichinh;
        $taichinhs = null;
        if(count($hv_taichinh) !== 0){
            foreach ($hv_taichinh as $key) {
                $taichinh_id = $key->id;
                $hocvien['tong_ngay_nghi'] = $key->tong_ngay_ngi;
                $hocvien['tong_ngay_co_mat'] = $key->tong_ngay_co_mat;
            }
            $data['id'] = $taichinh_id;
            $taichinhs = $this->hocvienService->filterTaiChinh($data);
        }
        return view('nguoinha.hocvien.hocphi', compact('taichinhs','hocvien'));
    }

    public function filterHocPhi($id,Request $request){
        $data['hoc_vien_id'] = $id;
        $data['month']= $request->month;
        $taichinh = $this->hocvienService->filterTaiChinh($data);
   
        if($taichinh !== false){
            return response()->json(['message'=>$taichinh],200);
        }
        return response()->json(['message'=>$taichinh],422);
    }
    public function diemSo()
    {  
        $nguoibaoho = Auth::guard('nguoibaoho')->user();
        $hocvien = $nguoibaoho->hocvien;
        $lophocs = $hocvien->lophoc;

        return view('nguoinha.hocvien.diemhocvien', compact('lophocs'));
    }
    public function filterDiemSo(Request $request){

        $lydodiem = LyDoDiem::all();
        $lophoc = LopHoc::find($request->id);
        $nguoibaoho = Auth::guard('nguoibaoho')->user();
        $data['id'] = $request->id;
        $data['hoc_vien_id'] = $nguoibaoho->hocvien->id;
        $hocviens = LopHoc::find($request->id)->hocvien;
        $diem_monhoc = $this->lophocService->diemHV($data);
        $diem_hv = [];
            foreach($hocviens as $hocvien )
            {
                foreach($diem_monhoc as $diem) {
                    if($diem->id == $hocvien->id){
                       foreach ($lydodiem as $lydo) {
                          if($lydo->id == $diem->ly_do_id){
                            $diem_hv[] = ['ngay'=>date('d-m-Y', strtotime($diem->created_at)),'ly_do'=>$lydo->ten,'diem'=>$diem->diem];
                          }

                       }
                     
                    }
                }
            }
        return response()->json($diem_hv);
    }

    public function filterDiemDanh(Request $request){
        $nguoibaoho = Auth::guard('nguoibaoho')->user();
        $hocvien = $nguoibaoho->hocvien;
        $lophoc = LopHoc::find($request->id);
       
        $diemdanh = $hocvien->diemdanh()->wherePivot('lop_hoc_id',$lophoc->id)->get();
        $data['id'] = $lophoc->id;
        $thoikhoabieu = $this->lophocService->thoikhoabieu($data);
        $diemdanhHocVien = [];
        $count = 0;
        foreach($thoikhoabieu as $thoi_khoa_bieu){
           foreach($diemdanh as $diem_danh){
               if(date("Y-m-d",strtotime($thoi_khoa_bieu->ngay)) == date("Y-m-d",strtotime($diem_danh->pivot->ngay))){
                   if($thoi_khoa_bieu->sang != NULL && $diem_danh->pivot->ca_hoc == 0){
                        $diemdanhHocVien[] = [
                            'ngay'=>date("d-m-Y",strtotime($thoi_khoa_bieu->ngay)),
                            'ca_hoc'=>$thoi_khoa_bieu->sang,
                            'diem_danh'=>1
                        ];
                   }if($thoi_khoa_bieu->chieu != NULL && $diem_danh->pivot->ca_hoc == 1){
                        $diemdanhHocVien[] = [
                            'ngay'=>date("d-m-Y",strtotime($thoi_khoa_bieu->ngay)),
                            'ca_hoc'=>$thoi_khoa_bieu->chieu,
                            'diem_danh'=>1
                        ];
                   }
               }
           }
           if($thoi_khoa_bieu->sang != NULL){
                $count++;
           }if($thoi_khoa_bieu->chieu != NULL){
                $count++;
           }
        }
        $lophoc['sobuoi'] = count($diemdanh).'/'.$count;
       return response()->json(['message'=>$diemdanhHocVien,'lophoc'=>$lophoc]);

    }

    public function tinhTrangNghien(Request $request){
        $nguoibaoho = Auth::guard('nguoibaoho')->user();
        $tinhtrangnghiens = $this->hocvienService->tinhtrangnghien($nguoibaoho->hocvien->id);
        return response()->json(['message'=>$tinhtrangnghiens]);
    }
}
