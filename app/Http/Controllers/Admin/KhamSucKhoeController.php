<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\KhamSucKhoeService;
use App\Http\Requests\Admin\KhamSucKhoeRequest;
use App\Models\HocVien;
use App\Exports\KhamSucKhoeExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
class KhamSucKhoeController extends Controller
{
    protected $khamSucKhoeService;

    public function __construct(KhamSucKhoeService $khamSucKhoeService)
    {
        $this->khamSucKhoeService = $khamSucKhoeService;
    }

    /**
     * Display a listing of the resource.
     *m
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.khamsuckhoe.index');        
       
    }

    public function list(Request $request)
    {
        $listkhamSucKhoe = $this->khamSucKhoeService->getListKhamSucKhoe($request->all());
        return $listkhamSucKhoe;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $hocvien = HocVien::find($id);
        return view('admin.khamsuckhoe.add',compact('hocvien'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data['hoc_vien_id'] = $request->hoc_vien_id;
        $data['noi_dung'] = strip_tags($request->noi_dung);
        $data['test_nhanh'] = $request->test_nhanh;
        $result = $this->khamSucKhoeService->store($data);
        DB::table('suc_khoe_toan_than')->insert([
            'kham_suc_khoe_id'=>$result->id,
            'toan_than'=>$request->toan_than,
            'mach'=>$request->mach,
            'huyet_ap'=>$request->huyet_ap,
            'nhiet_do'=>$request->nhiet_do,
            'can_nang'=>$request->can_nang,
            'nhip_tho'=>$request->nhip_tho
        ]);
        DB::table('suc_khoe_tam_than')->insert([
            'kham_suc_khoe_id'=>$result->id,
            'bieu_hien_chung'=>$request->bieu_hien_chung,
            'bieu_hien_khac'=>$request->bieu_hien_khac
        ]);
        DB::table('suc_khoe_co_quan')->insert([
            'kham_suc_khoe_id'=>$result->id,
            'ho_hap'=>$request->ho_hap,
            'tuan_hoan'=>$request->tuan_hoan,
            'tieu_hoa'=>$request->tieu_hoa,
            'tiet_nieu_sinh_duc'=>$request->tiet_nieu_sinh_duc,
            'mat'=>$request->mat
        ]);
        
        return redirect()->route('admin.khamsuckhoe.index')->with('message', 'Đánh giá sức khoẻ thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hocvien = HocVien::find($id);
        $khamsuckhoes = $this->khamSucKhoeService->show($id);
        return view('admin.khamsuckhoe.detail',compact('khamsuckhoes','hocvien'));  
    }

    public function count($id)
    {
        $hocvien = HocVien::find($id);
        $counts = DB::table('kham_suc_khoes')->where('hoc_vien_id',$id)->get();
        return view('admin.khamsuckhoe.count',compact('counts','hocvien'));  

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $khamsuckhoes = $this->khamSucKhoeService->show($id);
        $id_hoc_vien = $this->khamSucKhoeService->find($id)->hoc_vien_id;
        $hocvien = HocVien::find($id_hoc_vien);
        return view('admin.khamsuckhoe.edit',compact('khamsuckhoes','hocvien'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
        // $data = $this->khamSucKhoeService->find($id);
        $result = $this->khamSucKhoeService->update($request->all(),$id);
   
        DB::table('suc_khoe_toan_than')
              ->where('kham_suc_khoe_id', $id)
              ->update([
                'toan_than'=>$request->toan_than,
                'mach'=>$request->mach,
                'huyet_ap'=>$request->huyet_ap,
                'nhiet_do'=>$request->nhiet_do,
                'can_nang'=>$request->can_nang,
                'nhip_tho'=>$request->nhip_tho
            ]);
        DB::table('suc_khoe_tam_than')
            ->where('kham_suc_khoe_id', $id)
            ->update([
                'bieu_hien_chung'=>$request->bieu_hien_chung,
                'bieu_hien_khac'=>$request->bieu_hien_khac
        ]);

        DB::table('suc_khoe_co_quan')
            ->where('kham_suc_khoe_id', $id)
            ->update([
            'ho_hap'=>$request->ho_hap,
            'tuan_hoan'=>$request->tuan_hoan,
            'tieu_hoa'=>$request->tieu_hoa,
            'tiet_nieu_sinh_duc'=>$request->tiet_nieu_sinh_duc,
            'mat'=>$request->mat
        ]);
        return redirect()->route('admin.khamsuckhoe.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function excel($id){
        $hocvien = HocVien::find($id);
        if(count($hocvien->khamsuckhoe()->get()) > 0){
            return Excel::download(new KhamSucKhoeExport($hocvien),'Danh Sách Khám Sức Khoẻ '.$hocvien->ten.'.xlsx');
        }else{
            return back()->with('error','Học viên chưa khám lần nào');

        }

    }
}
