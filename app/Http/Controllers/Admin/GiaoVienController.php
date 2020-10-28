<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\GiaoVienService;
use App\Models\MonHoc;
use App\Models\GiaoVien;
use App\Models\HePhai;
use App\Models\ChucVu;
use App\Http\Requests\Admin\GiaoVienRequest;
use App\Exports\GiaoVienExport;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use Session;
use Storage;

class GiaoVienController extends Controller
{

    protected $giaovienService;

    public function __construct(GiaoVienService $giaovienService)
    {
        $this->giaovienService = $giaovienService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.giaovien.index');        
    }

    public function list(Request $request)
    {
        $listGiaoVien = $this->giaovienService->getListGiaoVien($request->all());
        return $listGiaoVien;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hephais = HePhai::all();
        $chucvus = ChucVu::all();
        $nationJson = file_get_contents("nation.json");  
        $nations = json_decode($nationJson, true);

        return view('admin.giaovien.addnew',compact('hephais','chucvus','nations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GiaoVienRequest $request)
    {
        $result = $this->giaovienService->store($request);

        if ($result) {
            Session::flash('message', trans('Thêm thành công ! '));

            return redirect()->route('admin.giaovien.index')->with('message', 'Thêm thành công');
        }

        Session::flash('error', trans('Thêm thất bại !'));

        return redirect()->route('admin.giaovien.index')->with('message', 'thêm thất bại');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $giaovien = $this->giaovienService->find($id);
        return view('admin.giaovien.detail',compact('giaovien'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $giaovien = $this->giaovienService->find($id);
        $hephais = HePhai::all();
        $chucvus = ChucVu::all();
        return view('admin.giaovien.edit',compact('giaovien','hephais','chucvus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GiaoVienRequest $request, $id)
    {
        $result = $this->giaovienService->updateGiaoVien($request,$id);

        if ($result) {
            Session::flash('message', trans('Thêm thành công ! '));
            return redirect()->route('admin.giaovien.index')->with('message', 'cập nhật môn học thành công');
        }

        Session::flash('error', trans('Thêm thất bại !'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->giaovienService->delete($id);
            return redirect()->route('admin.giaovien.index')->with('message', 'Xóa thành công');
        }catch (Exception $e) {
            report($e);
            return redirect()->route('admin.giaovien.index')->with('error', 'Xóa không thành công');
        }
    }

    public function excel(){
        return Excel::download(new GiaoVienExport(),'Danh Sách Giáo Viên.xlsx');
    }
}
