<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\TinhTrangNghienService;
use App\Services\Admin\HocVienService;
use App\Models\HocVien;
use DB;
class TinhTrangNghienController extends Controller
{
    protected $TinhTrangNghienService;

    public function __construct(TinhTrangNghienService $TinhTrangNghienService,HocVienService $hocvienService)
    {
        $this->TinhTrangNghienService = $TinhTrangNghienService;
        $this->hocvienService = $hocvienService;
    }

    /**
     * Display a listing of the resource.
     *m
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.tinhtrangnghien.index');        
       
    }

    public function list(Request $request)
    {
        $listhocvien = $this->TinhTrangNghienService->getListTinhTrangNghien($request->all());
        return $listhocvien;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $hocvien = HocVien::find($id);
        return view('admin.tinhtrangnghien.add',compact('hocvien'));
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
        $data['cac_benh_kem_theo'] = $request->cac_benh_kem_theo;
        $data['thuong_xuyen_su_dung'] = $request->thuong_xuyen_su_dung;
        $data['co_dia_di_ung'] = $request->co_dia_di_ung;
        $data['gia_dinh_ai_nghien'] = $request->gia_dinh_ai_nghien;
        $result = $this->TinhTrangNghienService->store($data);
        $request->request->add(['id' => $result->id]); 
        $quatrinhsudung = $this->TinhTrangNghienService->storeQTSD($request);
        $soluongcainghien = $this->TinhTrangNghienService->storeSLCN($request);
        return redirect()->route('admin.tinhtrangnghien.index')->with('message', 'Đánh giá tình trạng nghiện thành công');
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
        $tinhtrangnghiens = $this->hocvienService->tinhtrangnghien($hocvien->id);
        return view('admin.tinhtrangnghien.detail',compact('tinhtrangnghiens','hocvien'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hocvien = HocVien::find($id);
        $tinhtrangnghiens = $this->hocvienService->tinhtrangnghien($hocvien->id);
        return view('admin.tinhtrangnghien.edit',compact('tinhtrangnghiens','hocvien'));  
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
        $result = $this->TinhTrangNghienService->update($request->all(),$request->tinh_trang_nghien_id);
        $quatrinhsudung = $this->TinhTrangNghienService->updateQTSD($request);
        $soluongcainghien = $this->TinhTrangNghienService->updateSLCN($request);
       
      
        return redirect()->route('admin.tinhtrangnghien.show',$id);
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
}
