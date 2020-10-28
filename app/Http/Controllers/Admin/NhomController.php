<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\NhomService;
use App\Http\Requests\Admin\NhomRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NhomHocVienExport;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Nhom;
use App\Models\NhomCha;
use App\Models\HocVien;
use Exception;
use Session;
use Auth;

class NhomController extends Controller
{
    
    protected $nhomService;

    public function __construct(NhomService $nhomService)
    {
        $this->nhomService = $nhomService;
    }

    /**
     * Display a listing of the resource.
     *m
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        $nhom_chas = NhomCha::all();
        return view('admin.nhom.index',compact('hocviens','nhom_chas'));        
    }

    public function list(Request $request)
    {
        $listnhom = $this->nhomService->getListNhom($request->all());
        return $listnhom;
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
    public function store(NhomRequest $request)
    {
        $result = $this->nhomService->store($request);
        $nhom = $this->nhomService->find($result->id);
        $nhom->hocvien()->attach($nhom->truong_nhom_id);
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
        $nhom = $this->nhomService->find($id);
        $nhomCha = NhomCha::select('id','ten')->get();
        if(Auth::guard('admin')->user()->role == 1){
            $hocviens = HocVien::all();
        }else{
            if(Auth::guard('admin')->user()->gender == 1 ){
                $hocviens = HocVien::where('gioi_tinh','Nam')->get();
            }else{
                $hocviens = HocVien::where('gioi_tinh','Nữ')->with('nguoibaoho')->get();
            }
        }
        return view('admin.nhom.edit',compact('nhom','nhomCha','hocviens'));
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
        if(Nhom::where('ten',$request->ten)->where('id',$id)->first()){
            $request->request->remove('ten');
        }if(Nhom::where('ten',$request->ten)->first()){
            return back()->with('error', 'Tên nhóm đã trùng ! ');
        }
        $result = $this->nhomService->update($request->all(),$id);
        if ($result) {
            Session::flash('message', trans('Thêm thành công ! '));
            return redirect()->route('admin.nhom.index');
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
            $this->nhomService->delete($id);
            return redirect()->route('admin.nhom.index')->with('message', 'Xóa thành công');
        } catch (Exception $e) {
            report($e);
            return redirect()->route('admin.nhom.index')->with('error', 'Xóa không thành công');
        }
    }

    public function nhomHocVien($id)
    {
        $list_hv = [];
        if(Auth::guard('admin')->user()->role == 1){
            $hocviens = HocVien::all();
        }else{
            if(Auth::guard('admin')->user()->gender == 1 ){
                $hocviens = HocVien::where('gioi_tinh','Nam')->get();
            }else{
                $hocviens = HocVien::where('gioi_tinh','Nữ')->with('nguoibaoho')->get();
            }
        }
        $nhom =  $this->nhomService->find($id);
        // dd($hocviens,$nhom->hocvien);
        
        foreach($hocviens as $hocvien){
            if(!$nhom->hocvien->contains($hocvien))
            {
                $list_hv[] = $hocvien;
            }
        }
        // dd($list_hv);
        return view('admin.nhom.add_hv',compact('list_hv','nhom'));
    }
    public function nhomHocVienPost(Request $request)
    {
        $nhom =  $this->nhomService->find($request->id);
        $nhom->hocvien()->attach($request->hoc_vien_id);
        return redirect()->route('admin.nhom.index')->with('message', 'thêm học viên vào nhóm thành công');
    }

    public function nhomHocVienList($id)
    {
        $nhom = $this->nhomService->find($id);
        $hocviens = $nhom->hocvien;
        return view('admin.nhom.list_hv',compact('nhom','hocviens'));
    }

    public function nhomHocVienExport($id){
        $nhom = $this->nhomService->find($id);
        return Excel::download(new NhomHocVienExport($id), $nhom->ten.'.xlsx');
    }
}
