<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HocVien;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BaoCaoHocVienExport;

class BaoCaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.baocao.index');
    }

    public function filter(Request $request)
    {
        $month = date("m",strtotime($request->month));
        $year = date("Y",strtotime($request->month));
      
        $countHocVien = HocVien::count();
        $HocVienBoTronTrongThang = collect();
        $HocVienInTheMonth =  HocVien::whereMonth('ngay_vao', $month)->whereYear('ngay_vao', $year)->get();
        foreach (HocVien::all() as $hocvien) {
            if($hocvien->vephep()->where('thang_ve',$month)->where('ly_do',1)->get()->count()>0){
                $HocVienBoTronTrongThang->add($hocvien);
            }
        }
        $month = $request->month;
        return view('admin.baocao.index',compact('month','countHocVien','HocVienInTheMonth','HocVienBoTronTrongThang'));
    }

    public function excel($month){
        return Excel::download(new BaoCaoHocVienExport($month), $month.'.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
