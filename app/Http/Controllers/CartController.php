<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\Cart;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use session;
class CartController extends Controller
{
    //
    public function AddCart(Request $req, $id){
        $sanpham = SanPham::find($id);
        if($sanpham!=null){
            if ($req->session()->has('cart')) {
                //
                $nowcart=$req->session()->get('cart');  
        
            } else{
                $nowcart=null;
            }
                $newcart = new Cart($nowcart);
                $newcart->AddCart($sanpham, $id);
                $req->session()->put('cart', $newcart);
        
        }
        return view('user.pages.total_cart');
    }
    public function DeleteCart(Request $request, $id){
        if ($request->session()->has('cart')) {
            //
            $nowcart=$request->session()->get('cart'); 
    
        } else{
            $nowcart=null;
        }
            $newcart = new Cart($nowcart);
            $newcart->DeleteItemCart($id);
            if(count($newcart->products)>0){
                $request->session()->put('cart', $newcart);//nếu còn sp trong giả hàng put lại
            }
            else{
                $request->session()->forget('cart' ); // nếu k còn sản phẩm xóa luôn giỏ hàng
            }
            
            return view('user.pages.cart-list',compact('newcart'));
    }
    public function postBillandDetail(Request $request)
    {
        $this->validate($request,
        [
            'hoten'=>'required',
            'sdt'=>'required|min:10|max:10',
            'diachi'=>'required',
        ],
        [
            'hoten.required'=>'Vui lòng nhập tên đầy đủ',
            'diachi.required'=>'Vui lòng nhập điền địa chỉ',
            'sdt.min'=>'số điện thoại là 10 số',
            'sdt.max'=>'số điện thoại là 10 số',
        ]);
        $hoadon = new HoaDon();
        $hoadon->user_id = $request->id_user;
        $hoadon->hoten = $request->hoten;
        $hoadon->sdt = $request->sdt;
        $hoadon->diachi = $request->diachi;
        $hoadon->thanhtien = $request->thanhtien;
        $hoadon->trangthai ="Đã đặt";
        $hoadon->save();
        $chitiethoadon = new ChiTietHoaDon();
        $chitiethoadon->id_hoadon =  $hoadon->id;
        $chitiethoadon->TenSP = $request->dstensp;
        $chitiethoadon->SoLuong = $request->dssoluong;
        $chitiethoadon->Gia = $request->dsgia;
        $chitiethoadon->ThanhTien = $request->thanhtien;
        $chitiethoadon->TrangThai ="Đã đặt hàng";
        $chitiethoadon->save();
        $request->session()->forget('cart');
        return redirect()->route('user.index')->with('status', 'Đăt hàng thành công');
    }
}
