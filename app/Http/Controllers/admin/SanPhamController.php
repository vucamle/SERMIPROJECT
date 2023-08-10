<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LoaiSP;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Classes\Helper;
use App\Models\DanhMuc;
use Session;

class SanPhamController extends Controller
{
    //

    public function __construct()
    {
        $this->viewprefix='admin.sanpham.';
        $this->viewnamespace='admin/sanpham';
    }
    public function index()
    {
        $sanphams = SanPham::all();
        return view($this->viewprefix.'index', compact('sanphams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
   **/

  public function create()
  {
      // $category = LoaiSP::all();
      $danhmuc=DanhMuc::all();
      return view($this->viewprefix.'create')
      ->with('danhmuc',$danhmuc);
  }

  public function imageUpload(Request $request){
      if($request->hasFile('Image1')){
          if($request->file('Image1')->isValid()){
              $request->validate(['Image1'=>'required|image|mimes:jpeg,jpg,png|max:2048',]);
              $imageName = time().'.'.$request->Image1->extension();
              $request->Image1->move('image',$imageName);
              return $imageName;
          }
      }
      return 'x';
  }
  public function imageUpload2(Request $request){
      if($request->hasFile('Image2')){
          if($request->file('Image2')->isValid()){
              $request->validate(['Image2'=>'required|image|mimes:jpeg,jpg,png|max:2048',]);
              $imageName = time().'.'.$request->Image2->extension();
              $request->Image2->move('image',$imageName);
              return $imageName;
          }
      }
      return 'x';
  }
  public function store(Request $request)
  {
      //
      $sanpham= new SanPham;
      $sanpham->TenSP=$request->TenSP;
      $sanpham->DanhMuc=$request->DanhMuc;
      $sanpham->Gia=$request->Gia;
      $sanpham->GiaMoi=$request->GiaMoi;
      $sanpham->Image1=$this->imageUpload($request);
      $sanpham->Image2=$this->imageUpload2($request);
      $sanpham->SoLuong=$request->SoLuong;
      $sanpham->MoTa=$request->MoTa;
      $sanpham->TrangThai=$request->TrangThai;
      if($sanpham->save())
      {
          Session::flash('message', 'successfully!');
      }
      else
          Session::flash('message', 'Failure!');
      return redirect()->route('sanpham.index');
  }
      // $this->validate($request, [
      //     'TenSP' => 'required',
      //     'DanhMuc' => 'required',
      //     'Gia' => 'required',
      //     'GiaMoi' => 'required',
      //     'Image1' => 'required',
      //     'Image2' => 'required',
      //     'SoLuong'=>'required',
      //     'MoTa'=>'required',
      //     'TrangThai'=>'required',
      // ]);
    
      //if(Category::create($request->all()))
   

    public function edit($id)
    {
        $sanpham=SanPham::find($id);
        return view($this->viewprefix.'edit')->with('sanpham', $sanpham);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $sanpham = SanPham::find($id);
        $data=$request->validate([
            'TenSP' => 'required',
            'Gia' => 'required',
            'GiaMoi' => 'required',
            'Image1' => 'required',
            'Image2' => 'required',
            'SoLuong'=>'required',
            'MoTa'=>'required',
            'TrangThai'=>'required',
            
            'DanhMuc' => 'required',
        ]);

        $data['Image1']=$this->imageUpload($request);
        $data['Image2']=$this->imageUpload2($request);

        //if(Category::create($request->all()))
        if($sanpham->update($data))
        {
            Session::flash('message', 'successfully!');
        }
        else
            Session::flash('message', 'Failure!');
        return redirect()->route('sanpham.index');
    }
    public function destroy($id)
    {
        $sanpham=SanPham::find($id);
        $sanpham->delete();
        // if($sanpham->trangthai==0)
        // {
        //     $sanpham->trangthai=1;
        // }else
        // $sanpham->trangthai=0;
        // if($sanpham->update())
        //     Session::flash('message', 'successfully!');
        // else
        //     Session::flash('message', 'Failure!');
        return redirect()->route('sanpham.index');
    }
}
