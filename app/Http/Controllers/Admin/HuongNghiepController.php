<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\HuongNghiepService;
use App\Http\Requests\Admin\HuongNghiepRequest;
use App\Models\HocVien;
use Exception;
use Session;
use Auth;
class HuongNghiepController extends Controller
{

    protected $huongnghiepService;

    public function __construct(HuongNghiepService $huongnghiepService)
    {
        $this->huongnghiepService = $huongnghiepService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.huongnghiep.index');        
    }

    public function list(Request $request)
    {
        return $this->huongnghiepService->getListHuongNghiep($request->all());
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
    public function store(HuongNghiepRequest $request)
    {
        $result = $this->huongnghiepService->store($request);
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
        // return redirect()->route('admin.huongnghiep.index')->with('message', 'Thêm thành công');
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

    public function createHocVien($id){
        $huongnghiep =  $this->huongnghiepService->find($id);
        if(Auth::guard('admin')->user()->role == 1){
            $hocviens = HocVien::all();
        }else{
            if(Auth::guard('admin')->user()->gender == 1 ){
                $hocviens = HocVien::where('gioi_tinh','Nam')->get();
            }else{
                $hocviens = HocVien::where('gioi_tinh','Nữ')->with('nguoibaoho')->get();
            }
        }
        return view('admin.huongnghiep.add_hv',compact('huongnghiep','hocviens'));
    }
    
    public function postHocVien(Request $request,$id)
    {
        $huongnghiep = $this->huongnghiepService->find($id);
        $huongnghiep->hocvien()->attach($request->hoc_vien_id);
        return redirect()->route('admin.huongnghiep.index')->with('message', 'thêm học viên thành công');;
    }

    public function listHocVien($id){
        $huongnghiep = $this->huongnghiepService->find($id);
        return view('admin.huongnghiep.list_hv',compact('huongnghiep'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $huongnghiep =  $this->huongnghiepService->find($id);
        return response()->json($huongnghiep);
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
        $result = $this->huongnghiepService->update($request->all(),$id);
        if ($result) {
            return redirect()->route('admin.huongnghiep.index')->with('message', 'Sửa thành công');
        }
        return redirect()->route('admin.huongnghiep.index')->with('error', 'Sửa không thành công');

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
            $this->huongnghiepService->delete($id);
            return redirect()->route('admin.huongnghiep.index')->with('message', 'Xóa thành công');
        } catch (Exception $e) {
            report($e);
            return redirect()->route('admin.huongnghiep.index')->with('error', 'Xóa không thành công');
        }
    }
}
