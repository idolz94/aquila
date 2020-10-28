<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\HanhKiemService;
use App\Models\HanhKiem;
use App\Models\HocVien;
use DB;
class HanhKiemController extends Controller
{
    protected $HanhKiemService;

    public function __construct(HanhKiemService $hanhKiemService)
    {
        $this->hanhKiemService = $hanhKiemService;
    }

    /**
     * Display a listing of the resource.
     *m
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('admin.hanhkiem.index');        
       
    }

    public function list(Request $request)
    {
        $listhanhKiem = $this->hanhKiemService->getListHanhKiem($request->all());
        return $listhanhKiem;
    }

    public function show($id)
    {
      $hocvien = HocVien::find($id);
      return view('admin.hanhkiem.detail',compact('hocvien'));     
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $hoc_vien_id = explode('_',$request->hoc_vien_id);
        $data['hoc_vien_id'] = $hoc_vien_id[1];
        $result = $this->hanhKiemService->store($data);
        return redirect()->route('admin.hanhkiem.index')->with('message', 'Đánh giá hạnh kiểm thành công');
    }

    

}
