<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\HoaDon;
use Illuminate\Http\Request;
use App\Models\ChiTietHoaDon;
use Session;

class ChiTietHoaDonController extends Controller
{
    //

    public function __construct()
    {
        $this->viewprefix='admin.chitiethoadon.';
        $this->viewnamespace='admin/chitiethoadon';
    }
    public function index()
    {
        $chitiethoadons = ChiTietHoaDon::all();
        return view($this->viewprefix.'index', compact('chitiethoadons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
   **/

    public function create()
    {
        //
        return view($this->viewprefix.'create');
    }

    public function store(Request $request)
    {
        //
        $chitiethoadon= new ChiTietHoaDon();
        $this->validate($request, [
            'id_hoadon'=>'required',
            'TenSP' => 'required',
            'SoLuong' => 'required',
            'Gia' => 'required',
            'KhuyenMai' => 'required',
            'ThanhTien' => 'required',
           
        ]);
        $chitiethoadon->id_hoadon=$request->id_hoadon;
        $chitiethoadon->TenSP=$request->TenSP;
        $chitiethoadon->SoLuong=$request->SoLuong;
        $chitiethoadon->Gia=$request->Gia;
        $chitiethoadon->KhuyenMai=$request->KhuyenMai;
        $chitiethoadon->ThanhTien=$request->ThanhTien;
        
        //if(Category::create($request->all()))
        if($chitiethoadon->save())
        {
            Session::flash('message', 'successfully!');
        }
        else
            Session::flash('message', 'Failure!');
        return redirect()->route('chitiethoadon.index');
    }

    public function edit(ChiTietHoaDon $chitiethoadon)
    {
        return view($this->viewprefix.'edit')->with('chitiethoadon', $chitiethoadon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChiTietHoaDon  
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, ChiTietHoaDon $chitiethoadon)
    {
        $data=$request->validate([
            
            'TenSP' => 'required',
            'SoLuong' => 'required',
            'Gia' => 'required',
            'KhuyenMai' => 'required',
            'ThanhTien'=>'required',
            
        ]);    
        
     
        
        //if(Category::create($request->all()))
        if($chitiethoadon->update($data))
        {
            Session::flash('message', 'successfully!');
        }
        else
            Session::flash('message', 'Failure!');
        return redirect()->route('chitiethoadon.index');
    }
    public function destroy($id)
    {   
        $chitiethoadon=ChiTietHoaDon::find($id);
        if($chitiethoadon->TrangThai=='Đã hủy'){
            $chitiethoadon->TrangThai='Đã đặt';
        }else
        $chitiethoadon->TrangThai='Đã hủy';
        if($chitiethoadon->update())
            Session::flash('message', 'successfully!');
        else
            Session::flash('message', 'Failure!');
        return redirect()->route('chitiethoadon.index');
    }
    
}
