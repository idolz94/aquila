<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\NhomChaService;
use App\Http\Requests\Admin\NhomChaRequest;
use Exception;
use Session;
class NhomChaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $nhomChaService;

    public function __construct(NhomChaService $nhomChaService)
    {
        $this->nhomChaService = $nhomChaService;
    }

    /**
     * Display a listing of the resource.
     *m
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('admin.nhomcha.index');        
    }

    public function list(Request $request)
    {
        $listnhom = $this->nhomChaService->getListNhomCha($request->all());
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
    public function store(NhomChaRequest $request)
    {
        $result = $this->nhomChaService->store($request);
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
        $nhom = $this->nhomChaService->find($id);

        return view('admin.nhomcha.edit',compact('nhom'));
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
        $result = $this->nhomChaService->update($request->all(),$id[1]);
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
            $this->nhomChaService->delete($id);
            return redirect()->route('admin.nhomcha.index')->with('message', 'Xóa thành công');
        } catch (Exception $e) {
            report($e);
            return redirect()->route('admin.nhomcha.index')->with('error', 'Xóa không thành công');
        }
    }
}
