<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\KyLuatService;
use App\Models\HanhKiem;
use App\Models\KyLuat;
use App\Models\HocVien;
use DB;
class KyLuatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $kyLuatService;

    public function __construct(KyLuatService $kyLuatService)
    {
        $this->kyLuatService = $kyLuatService;
    }

    /**
     * Display a listing of the resource.
     *m
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.kyluat.index');        
       
    }

    public function list(Request $request)
    {
        $listkyLuat = $this->kyLuatService->getListKyLuat($request->all());
        return $listkyLuat;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $hocvien = HocVien::find($id);
        return view('admin.kyluat.create',compact('hocvien'));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $hoc_vien_id = explode('_',$request->hoc_vien_id);
        $data['hoc_vien_id'] = $hoc_vien_id[1];
        $data['ngay']= \Carbon\Carbon::now();
        $result = $this->kyLuatService->store($data);
        return redirect()->route('admin.kyluat.index')->with('message', 'Đánh giá kỷ luật  thành công');
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
        $kyluats = $hocvien->kyluat()->get();
        return view('admin.kyluat.detail',compact('kyluats','hocvien'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
