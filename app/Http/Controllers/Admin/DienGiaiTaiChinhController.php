<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\DienGiaiTaiChinhService;
use App\Models\DienGiaiTaiChinh;
use App\Http\Requests\Admin\DienGiaiTaiChinhRequest;
use Exception;
use Session;
class DienGiaiTaiChinhController extends Controller
{


    protected $diengiaitaichinhService;

    public function __construct(DienGiaiTaiChinhService $diengiaitaichinhService)
    {
        $this->diengiaitaichinhService = $diengiaitaichinhService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('admin.diengiai-taichinh.index');        
       
    }

    public function list(Request $request)
    {
        $listdiengiaitaichinh = $this->diengiaitaichinhService->getListDienGiaiTaiChinh($request->all());
        return $listdiengiaitaichinh;
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
    public function store(DienGiaiTaiChinhRequest $request)
    {
        $result = $this->diengiaitaichinhService->store($request);

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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->diengiaitaichinhService->find($id);
        return view('admin.diengiai-taichinh.edit',compact('data'));
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
        // $id = explode('_',$id);
        $result = $this->diengiaitaichinhService->update($request->all(),$id);
        if ($result) {
            return redirect()->route('admin.diengiai-taichinh.index')->with('message', 'Sửa thành công');
        }
        return redirect()->route('admin.diengiai-taichinh.index')->with('error', 'Sửa không thành công');
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
            $this->diengiaitaichinhService->delete($id);
            return redirect()->route('admin.diengiai-taichinh.index')->with('message', 'Xóa thành công');
        }catch (Exception $e) {
            report($e);
            return redirect()->route('admin.diengiai-taichinh.index')->with('error', 'Xóa không thành công');
        }
    }
}
