<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HoaDon;
use Session;

class HoaDonController extends Controller
{
    public function __construct()
    {
        $this->viewprefix='admin.hoadon.';
        $this->viewnamespace='admin/hoadon';
    }
    public function index()
    {
        $hoadons = HoaDon::all();
        return view($this->viewprefix.'index', compact('hoadons'));
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
        
        $hoadon= new HoaDon();
        $this->validate($request, [
            'user_id' => 'required',
            'hoten' => 'required',
            'sdt' => 'required',
            'diachi' => 'required',
            'thanhtien' => 'required',
            'trangthai'=>'required',
        
        ]);
        $hoadon->user_id=$request->user_id;
        $hoadon->hoten=$request->hoten;
        $hoadon->sdt=$request->sdt;
        $hoadon->diachi=$request->diachi;
        $hoadon->thanhtien=$request->thanhtien;
        $hoadon->trangthai=$request->trangthai;
        
        //if(Category::create($request->all()))
        if($hoadon->save())
            Session::flash('message', 'successfully!');
        else
            Session::flash('message', 'Failure!');
        return redirect()->route('hoadon.index');
             
    }

    public function show(HoaDon $hoadon)
    {
        //
       
    }

    public function edit(HoaDon $hoadon)
    {
        return view($this->viewprefix.'edit')->with('hoadon', $hoadon);
    }

    public function update(Request $request, Hoadon $hoadon)
    {
        $data=$request->validate([
            'hoten' => 'required',
            'sdt' => 'required',
            'diachi' => 'required',
            'thanhtien' => 'required',
            'trangthai'=>'required',
        ]);    
        
        //if(Category::create($request->all()))
        if($hoadon->update($data))
        {
            Session::flash('message', 'successfully!');
        }
        else
            Session::flash('message', 'Failure!');
        return redirect()->route('hoadon.index');
    }


    public function destroy($id)
    {
        $hoadon=HoaDon::find($id);
        if($hoadon->trangthai=='Đã hủy')
        {
            $hoadon->trangthai='Đã đặt';
        }else
        $hoadon->trangthai='Đã hủy';
        if($hoadon->save())
            Session::flash('message', 'successfully!');
        else
            Session::flash('message', 'Failure!');
        return redirect()->route('hoadon.index');
    }
    public function chitiethoadonlist($id)
    {
        $hoadon=HoaDon::find($id);
        $chitiethoadons=HoaDon::find($id)->chitiethoadon;
        return view($this->viewprefix.'chitiethoadonlist',compact('chitiethoadons','hoadon'));
    }
}
