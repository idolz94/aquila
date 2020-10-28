<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DienGiaiTaiChinh;
use App\Models\TaiChinh;
use App\Models\HocVien;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TaiChinhExport;
use App\Services\Admin\HocVienService;
use DB;
class TaiChinhController extends Controller
{

    public function __construct(HocVienService $hocvienService)
    {
        $this->hocvienService = $hocvienService;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $hocvien = HocVien::find($request->hoc_vien_id);
        $diengiai_thu = DienGiaiTaiChinh::where('thu_chi',0)->get();
        $diengiai_chi = DienGiaiTaiChinh::where('thu_chi',1)->get();
        if($hocvien->taichinh()->get()->count() >0){
            $hocvien['taichinh'] = 1;
        }
    
       
        return view('admin.student.form',compact('diengiai_thu','diengiai_chi','hocvien'));
    }

    public function filterMonth(Request $request,$id){
        $hocvien = HocVien::find($id);
        $month = new \Carbon\Carbon($request->month); 
        $days_month = $month->daysInMonth;
        $end_month = $month->endOfMonth();
        $first_month = $month->firstOfMonth();
        $ngay_nghi = 0;
        if($hocvien->vephep()->where('thang_ve',$month->format('m'))->whereNotNull('thang_vao')->get()->count()>0){
            if($hocvien->vephep()->where('thang_ve',$month->format('m'))->where('thang_vao',$month->format('m'))->get()->count()){
                foreach ($hocvien->vephep()->where('thang_ve',$month->format('m'))->where('thang_vao',$month->format('m'))->get() as $value) {
                    $ngay_ve =  new \Carbon\Carbon($value->ngay_ve);
                    $ngay_vao =  new \Carbon\Carbon($value->ngay_vao); 
                    $ngay_nghi += $ngay_ve->diff($ngay_vao)->days;
                }
            }elseif($hocvien->vephep()->where('thang_ve',$month->format('m'))->get()->count()){
                foreach ($hocvien->vephep()->where('thang_ve',$month->format('m'))->get() as $value) {
                    $ngay_ve =  new \Carbon\Carbon($value->ngay_ve);
                    $ngay_nghi += $ngay_ve->diff($end_month)->days;
                }
            }elseif($hocvien->vephep()->where('thang_vao',$month->format('m'))->get()->count()){
                foreach ($hocvien->vephep()->where('thang_vao',$month->format('m'))->get() as $value) {
                    $ngay_vao =  new \Carbon\Carbon($value->ngay_ve);
                    $ngay_nghi += $ngay_vao->diff($first_month)->days;
                }
            }
        }
        $taichinh = $hocvien->taichinh()->where('thang',$month->format('m'))->first();
        if($taichinh !== NULL){
            $data['id'] = $taichinh->id;
            $taichinh = $this->hocvienService->filterTaiChinh($data);
        }
        $ngay_co_mat = $days_month - $ngay_nghi;
        return response()->json(['taichinh'=>$taichinh,'ngay_co_mat'=>$ngay_co_mat,'ngay_nghi'=>$ngay_nghi]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $thang = date("m",strtotime($request->thang));
        $so_tien_arr = $request->so_tien;
        if($taichinh =  TaiChinh::where('hoc_vien_id',$request->hoc_vien_id)->where('thang',$thang)->first()){
            $taichinh->tong_ngay_ngi = $request->tong_ngay_ngi;
            $taichinh->tong_ngay_co_mat = $request->tong_ngay_co_mat;
            $taichinh->save();
            foreach ($request->dien_giai_tai_chinh as $key) {
                $diengiai = DienGiaiTaiChinh::find($key);
                $so_tien = array_shift($so_tien_arr);
                if($diengiai->thu_chi == 0)
                    $thu = (int)str_replace(",","",$so_tien);
                else
                    $thu = null;
                if($diengiai->thu_chi == 1)
                    $chi = (int)str_replace(",","",$so_tien);
                else
                    $chi = null;
                DB::table('thu_chi_tai_chinhs')->where('tai_chinh_id',$taichinh->id)->where('dien_giai_tai_chinh_id',$key)
                ->update([
                    'thu' => $thu,
                    'chi' => $chi,
                    ]
                );
            }
        }else{
            
            $taichinh = TaiChinh::create([
                'hoc_vien_id'=>$request->hoc_vien_id,
                'tong_ngay_ngi'=>$request->tong_ngay_ngi,
                'tong_ngay_co_mat'=>$request->tong_ngay_co_mat,
                'thang' => $thang,
            ]);
            foreach ($request->dien_giai_tai_chinh as $key) {
                $diengiai = DienGiaiTaiChinh::find($key);
                $so_tien = array_shift($so_tien_arr);
                if($diengiai->thu_chi == 0)
                    $thu = (int)str_replace(",","",$so_tien);
                else
                    $thu = null;
                if($diengiai->thu_chi == 1)
                    $chi = (int)str_replace(",","",$so_tien);
                else
                    $chi = null;
                DB::table('thu_chi_tai_chinhs')->insert([
                    'tai_chinh_id' => $taichinh->id,
                    'dien_giai_tai_chinh_id' => $key,
                    'thu' => $thu,
                    'chi' => $chi,
                    ]
                );
            }
        }
        $thu_chi_tai_chinh =  DB::table('thu_chi_tai_chinhs')->where('tai_chinh_id',$taichinh->id);
        DB::table('hoc_viens')
        ->where('id',$request->hoc_vien_id)
        ->update(['tai_chinh_con_lai' => $thu_chi_tai_chinh->sum('thu') - $thu_chi_tai_chinh->sum('chi')]);
        return redirect()->route('admin.hoc-vien.show',$request->hoc_vien_id)->with('message', 'thêm tài chính thành công');
    }

    public function export($id){
        $hocvien = HocVien::find($id);
        return Excel::download(new TaiChinhExport($hocvien), 'Tài chính HV  '.$hocvien->ten.'.xlsx');
    }

}
