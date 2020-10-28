<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\PhongService;
use App\Http\Requests\Admin\PhongRequest;
use Exception;
use App\Models\Phong;
use App\Models\HocVien;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PhongExport;
use Auth;
class PhongController extends Controller
{
    protected $phongService;

    public function __construct(PhongService $phongService)
    {
        $this->phongService = $phongService;
    }

    /**
     * Display a listing of the resource.
     *m
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hocviens = HocVien::all();
        return view('admin.phong.index',compact('hocviens'));        
       
    }

    public function list(Request $request)
    {
        $listPhong = $this->phongService->getListPhong($request->all());
        return $listPhong;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    public function createHocVien($id)
    {
        $phong = $this->phongService->find($id);
        if(Auth::guard('admin')->user()->role == 1){
            $hocvienAll = HocVien::all();
        }else{
            if(Auth::guard('admin')->user()->gender == 1 ){
                $hocvienAll = HocVien::where('gioi_tinh','Nam')->get();
            }else{
                $hocvienAll = HocVien::where('gioi_tinh','Nữ')->with('nguoibaoho')->get();
            }
        }
        $hocviens = [];
        foreach ($hocvienAll as $key) {
            if($key->phong->isEmpty()){
                $hocviens[] = $key;
            }
        }
        return view('admin.phong.form-hv',compact('phong','hocviens'));      
    }
    
    public function hocvienAll()
    {
        if(Auth::guard('admin')->user()->role == 1){
            $hocvienAll = HocVien::all();
        }else{
            if(Auth::guard('admin')->user()->gender == 1 ){
                $hocvienAll = HocVien::where('gioi_tinh','Nam')->get();
            }else{
                $hocvienAll = HocVien::where('gioi_tinh','Nữ')->with('nguoibaoho')->get();
            }
        }
        // foreach ($hocvienAll as $key) {
        //     if($key->phong->isEmpty()){
        //         $hocviens[] = $key;
        //     }
        // }
        return response()->json($hocvienAll);
    }

    public function postHocVien(Request $request)
    {   
        // dd($request->all());
        $phong = $this->phongService->find($request->id);
        $phong->hocvien()->attach($request->hoc_vien_id,['updated_at'=>null]);
        return response()->json('success',200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhongRequest $request)
    {
        $result = $this->phongService->store($request);
        $phong = $this->phongService->find($result->id);
        $phong->hocvien()->attach($result->ten_truong_phong,['updated_at'=>null]);
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
    public function show($id,Request $request)
    {
        $phong = $this->phongService->find($id);
        $phongAll = Phong::all();
        foreach($phongAll as $key =>$item){
            if($item->id == $id){
                unset($phongAll[$key]);
            }
        }
        if($request->path() == 'phong/add_truong_phong/'.$id){
            return view('admin.phong.add_truongphong',compact('phong'));
        }
        return view('admin.phong.detail',compact('phong','phongAll'));
    }

    public function storeTruongPhong(Request $request)
    {
     
        $phong = $this->phongService->find($request->id);
        $phong->ten_truong_phong = $request->ten_truong_phong;
        $phong->save();
        return redirect()->route('admin.phong.index')->with('message', 'thay đổi trưởng phòng thành công');
    }

    public function chuyenPhong(Request $request)
    {
        if($request->ly_do ==NULL){
            return back()->with('error','Chưa có lý do chuyển phòng');
        }
        $hoc_vien_id = explode('_',$request->hoc_vien_id);
        $phong_old = $this->phongService->find($request->phong_old);
        if($phong_old->ten_truong_phong == $hoc_vien_id[1]){
            $phong_old->ten_truong_phong = NULL;
            $phong_old->save();
        }
        $phong_new = Phong::find($request->phong_new);
        $phong_new->hocvien()->attach($hoc_vien_id[1],['updated_at'=>null]);
        $phong_old->hocvien()->updateExistingPivot($hoc_vien_id[1],['type'=>0,'ly_do'=>$request->ly_do]);
        return redirect()->route('admin.phong.show',$phong_new->id)->with('message', 'chuyển phòng thành công');
    }

    public function showHocVien($id){
        $hocvien = HocVien::find($id);
        return view('admin.phong.lichsu_chuyenphong',compact('hocvien'));
    }

    public function phongHocVien($id){
      
        $hocvien = $this->phongService->find($id)->hocvien;
        return response()->json($hocvien);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if(Auth::guard('admin')->user()->role == 1){
            $hocviens = HocVien::all();
        }else{
            if(Auth::guard('admin')->user()->gender == 1 ){
                $hocviens = HocVien::where('gioi_tinh','Nam')->get();
            }else{
                $hocviens = HocVien::where('gioi_tinh','Nữ')->with('nguoibaoho')->get();
            }
        }
        $phong = $this->phongService->find($id);
        return view('admin.phong.edit',compact('phong','hocviens'));
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
        $id = explode('_',$id);
        $phong = $this->phongService->find($id[1]);
        if($phong->ten_phong == $request->ten_phong){
            $phong->vi_tri = $request->vi_tri;
            $phong->save();
            Session::flash('message', trans('Thêm thành công ! '));
            return response()->json([
                'status' => true,
            ]);
        }else{
            if($request->ten_phong !== NULL && $request->vi_tri !== NULl){
                $result = $this->phongService->update($request->all(),$id[1]);
                if ($result) {
                    Session::flash('message', trans('Thêm thành công ! '));
                    return response()->json([
                        'status' => true,
                    ]);
                }
            }
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
            $this->phongService->delete($id);
            return redirect()->route('admin.phong.index')->with('message', 'Xóa thành công');
        } catch (Exception $e) {
            report($e);
            return redirect()->route('admin.phong.index')->with('error', 'Xóa không thành công');
        }
    }

    public function export($id){
        $phong = $this->phongService->find($id);
        return Excel::download(new PhongExport($phong), 'Phòng '.$phong->ten_phong.'.xlsx');

    }
}
