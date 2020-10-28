<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\VePhepService;
use App\Models\VePhep;
use App\Http\Requests\Admin\VePhepRequest;
use Exception;
use Session;
class VePhepController extends Controller
{

    protected $vePhepService;

    public function __construct(VePhepService $vePhepService)
    {
        $this->vePhepService = $vePhepService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function list($id)
    {
        $listVePhep = $this->vePhepService->getListVePhep($id);
        return $listVePhep;
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
    public function store(VePhepRequest $request)
    {
        $request->request->add(['thang_ve' => date("m",strtotime($request->ngay_ve))]);
        if($request->ngay_vao !== NULL){
            $request->request->add(['thang_vao' => date("m",strtotime($request->ngay_vao))]);
        }
        $result = $this->vePhepService->store($request);
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
        dd($id);
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
        $result = $this->vePhepService->update($request->all(),$id);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $hocvien = $this->vePhepService->find($id);
            $this->vePhepService->delete($id);
            return redirect()->route('admin.hoc-vien.ve-phep',$hocvien->hoc_vien_id)->with('message', 'Xóa thành công');
        } catch (Exception $e) {
            report($e);
            return redirect()->route('admin.hoc-vien.ve-phep',$hocvien->hoc_vien_id)->with('error', 'Xóa không thành công');
        }
    }
}
