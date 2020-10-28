<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\BoMonService;
use App\Http\Requests\Admin\BoMonRequest;
use Exception;
use Session;

class BoMonController extends Controller
{

    protected $bomonService;

    public function __construct(BoMonService $bomonService)
    {
        $this->bomonService = $bomonService;
    }

    /**
     * Display a listing of the resource.
     *m
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
        return view('admin.bomon.index');        
       
    }

    public function list(Request $request)
    {
        $listBoMon = $this->bomonService->getListBoMon($request->all());
        return $listBoMon;
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
    public function store(BoMonRequest $request)
    {
        $result = $this->bomonService->store($request);

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
        $bomon = $this->bomonService->find($id);
        return view('admin.bomon.edit',compact('bomon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BoMonRequest $request, $id)
    {
        $result = $this->bomonService->update($request->all(),$id);

        if ($result) {
            Session::flash('message', trans('Thêm thành công ! '));
            return response()->json([
                'status' => true,
            ]);
            // return redirect()->route('admin.bomon.index');
        }

        Session::flash('error', trans('Thêm thất bại !'));
        return response()->json([
            'status' => false,
        ]);
        // return back();
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
            $this->bomonService->delete($id);
            return redirect()->route('admin.bomon.index')->with('message', 'Xóa thành công');
        }catch (Exception $e) {
            report($e);
            return redirect()->route('admin.bomon.index')->with('error', 'Xóa không thành công');
        }
    }
}
