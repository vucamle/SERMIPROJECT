<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\BinhLuan;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use Carbon\Carbon;

class PagesController extends Controller
{
    //
    public function __construct()
    {
        $this->viewprefix='user.pages.';
        $this->viewnamespace='user/';
    }
    public function index()
    {
    
        $topfuture=SanPham::where('danhmuc',1)->where('trangthai',1)->paginate(4);
        $bestseller=SanPham::where('danhmuc',2)->where('trangthai',1)->paginate(4);
        $allimagesp = SanPham::where('trangthai',1);
        return view($this->viewprefix.'index',compact('topfuture','bestseller','allimagesp'));
    }
    public function shop()
    {
        $sanphams = SanPham::where('trangthai',1)->get();
        return view($this->viewprefix.'shop',compact('sanphams'));
    }
    public function about()
    {
        
        return view($this->viewprefix.'about');
    }
    public function login()
    {
        
        return view($this->viewprefix.'login');
    }
    public function cart(Request $request)
    {
        $newcart = $request->session()->get('cart');
        return view($this->viewprefix.'cart', compact('newcart'));
    }
    public function checkout()
    {
        if(session()->has('cart'))
        {
            $dssanpham = session()->get('cart');
          
        }
        if(session()->has('infoUser'))
        {
            return view($this->viewprefix.'checkout', compact('dssanpham'));
        }
        else
        return redirect('user/login')->with('status', 'Vui lòng đăng nhập trước khi thanh toán');
    }
    public function gallery()
    {
        $fruits=SanPham::where('MaLoai',1);
        $vegetables=SanPham::where('MaLoai',2)->paginate(3);
        $poddedvegetables=SanPham::where('MaLoai',3)->paginate(3);
        return view($this->viewprefix.'gallery', compact('fruits','vegetables','poddedvegetables'));
    }
    public function single($id)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        $binhluan = BinhLuan::where('id_sanpham',$id)->where('trangthai',1)->get();
        $sanpham = SanPham::where('id',$id)->where('trangthai',1)->get();
        $futuredproducts = SanPham::where('danhmuc',3)->where('trangthai',1)->get();
        return view($this->viewprefix.'single',compact('sanpham','futuredproducts','binhluan','date'));
    }
    public function postComment(Request $request)
    {
        $this->validate($request,
        [
            'noidung'=>'required'
        ],
        [
            'noidung.required'=>"Vui lòng nhập nội dung"
        ]);
        $binhluan = new BinhLuan();
        $binhluan->id_user=$request->id_user;
        $binhluan->name=$request->name;
        $binhluan->id_sanpham=$request->id_sanpham;
        $binhluan->noidung=$request->noidung;
        $binhluan->trangthai=$request->trangthai;
        $binhluan->ngaydang=$request->ngaydang;
        if($binhluan->save())
        {
            $binhluans = BinhLuan::where('id_sanpham',$binhluan->id_sanpham)->get();
            return view('user.pages.binhluan',compact('binhluans'));  
        }
    }
    public function myBill($id)
    {
        $hoadons=HoaDon::where('user_id',$id)->get();
        return view("user.pages.mybill", compact('hoadons'));
    }
    public function myDetailBill($id)
    {
        $chitiethoadons=ChiTietHoaDon::where('id_hoadon',$id)->get();
        return view("user.pages.myDetailBill", compact('chitiethoadons'));
    }
    public function cancelBill($id)
    {
       $hoadon=HoaDon::find($id);
       $hoadon->TrangThai="Đã hủy";
       $hoadon->update();
       $chitiethoadon = ChiTietHoaDon::find($id);
       $chitiethoadon->TrangThai = "Đã hủy";
       $chitiethoadon->update();
       return redirect()->back();
    }
    public function search(Request $request)
    {
        $q = $request->q;
        $kq = SanPham::where('TenSP','like','%'.$q.'%')->where('trangthai',1)->get();
        return view('user.pages.search',compact('kq','q'));
    }
}
