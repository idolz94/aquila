<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\SuKienService;
use App\Http\Requests\Admin\SuKienRequest;
use App\Models\SuKien;
use App\Models\HocVien;
use App\Exports\SuKienExport;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use Session;
use Auth;
class SuKienController extends Controller
{
    protected $sukienService;

    public function __construct(SuKienService $sukienService)
    {
        $this->sukienService = $sukienService;
    }

    /**
     * Display a listing of the resource.
     *m
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.sukien.index');        
    }

    public function list(Request $request)
    {
        return $this->sukienService->getListSuKien($request->all());
    }

    public function hocVien($id)
    {
        $sukien = $this->sukienService->find($id);
        if(Auth::guard('admin')->user()->role == 1){
            $hocviens = HocVien::all();
        }else{
            if(Auth::guard('admin')->user()->gender == 1 ){
                $hocviens = HocVien::where('gioi_tinh','Nam')->get();
            }else{
                $hocviens = HocVien::where('gioi_tinh','Nữ')->with('nguoibaoho')->get();
            }
        }
        foreach($hocviens as $key =>$hocvien){
            if(!$hocvien->sukien->isEmpty()){
                foreach($hocvien->sukien as $item){
                    if($sukien->id == $item->id){
                        unset($hocviens[$key]);
                    }
                }
               
            }
        }
        return view('admin.sukien.add-hv',compact('sukien','hocviens'));
    }

    public function hocVienPost(Request $request)
    {
 
        $sukien = $this->sukienService->find($request->id);
        $sukien->hocvien()->attach($request->hoc_vien_id);
        return redirect()->route('admin.sukien.index',$sukien->id)->with('message', 'thêm học viên vào sự kiện thành công');
    }

    public function updateKetQua(Request $request){
        $id = explode('_',$request->id);
        $data = $request->all();
        $data['noi_dung'] = strip_tags($data['noi_dung']);
        $data['ket_qua'] = strip_tags($data['ket_qua']);
        $result = $this->sukienService->update($data,$id[1]);
        return redirect()->route('admin.sukien.show',$id[1])->with('message', 'cập nhật kết quả thành công'); 
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
    public function store(SuKienRequest $request)
    {
        $sukiens = $request->all();
        if($sukiens['ma_mau'] == NULL){
            $sukiens['ma_mau'] = "#007bff";
        }
        $sukiens['noi_dung'] = strip_tags($sukiens['noi_dung']);
        $result = $this->sukienService->store($sukiens);
        if ($result) {
            Session::flash('message', trans('Thêm thành công ! '));
            return response()->json([
                'status' => true,
            ]);
        }

        Session::flash('error', trans('Thêm thất bại !'));

        return response()->json([
            'status' => false,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sukien = $this->sukienService->find($id);
        // dd($sukien->hocvien);
        return view('admin.sukien.detail',compact('sukien'));
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
        if(Auth::guard('admin')->user()->role == 1){
            try {
                $this->sukienService->delete($id);
                return redirect()->route('admin.sukien.index')->with('message', 'Xóa thành công');
            } catch (Exception $e) {
                report($e);
                return redirect()->route('admin.sukien.index')->with('error', 'Xóa không thành công');
            }
        }else{
            return back()->with('message','Bạn không có quyền xoá');
        }
    }

    public function excel($id){
        $sukien = $this->sukienService->find($id);
        return Excel::download(new SuKienExport($sukien),'Sự kiện '.$sukien->ten.'.xlsx');

    }
}
