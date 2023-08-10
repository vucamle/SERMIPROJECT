<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Nhacungcap;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Models\LoaiSP;
use Session;
class LoaispController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('CheckAdminLogin');
        $this->viewprefix='admin.loaisanpham.';
        $this->viewnamespace='panel/loaisanpham';
    }
    public function index()
    {
        $loaisanpham = LoaiSP::all();
        return view($this->viewprefix.'index')->with('cate', $loaisanpham);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->viewprefix.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loaisanpham = new LoaiSP();
        $this->validate($request, [
            'tenloai'=>'required',
            'trangthai' => 'required',
        ]);
        // $request->image = $this->imageUpload($request);
        $loaisanpham->tenloai=$request->tenloai;
        $loaisanpham->trangthai=$request->trangthai;
        if($loaisanpham->save())
            Session::flash('message', 'successfully!');
        else
            Session::flash('message', 'Failure!');
        return redirect()->route('loaisanpham.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(LoaiSP $loaisanpham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $loaisanpham=Loaisp::find($id);
        return view($this->viewprefix.'edit')->with('loaisanpham', $loaisanpham);
        // return view($this->viewprefix.'edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $loaisanpham=Loaisp::find($id);
        $this->validate($request, [
            'tenloai'=>'required',
            'trangthai' => 'required',

        ]);
        if($loaisanpham->update($request->all()))
            Session::flash('message', 'successfully!');
        else
            Session::flash('message', 'Failure!');
        return redirect()->route('loaisanpham.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */

    public function splist($id){
        $loaisanpham=LoaiSP::find($id);
        $sanphams=LoaiSP::findOrFail($id)->sanpham;
        return view($this->viewprefix.'splist',compact('loaisanpham','sanphams'));
    }
    public function destroy($id)
    {
        $loaisanpham = LoaiSP::find($id);
        if($loaisanpham->trangthai==0)
        {
            $loaisanpham->trangthai=1;
        }else
        $loaisanpham->trangthai =0;
        if($loaisanpham->update())
            Session::flash('message', 'successfully!');
        else
            Session::flash('message', 'Failure!');
        return redirect()->route('loaisanpham.index');
    }
}
