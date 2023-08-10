<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\LoaiSP;
use App\Models\ThongBao;
use App\Models\GioHang;
use App\Models\ChiTietGioHang;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use App\Models\User;
use App\Models\DetailCart;
use App\Classes\Helper;
use session;
use Carbon\Carbon;
class CartController extends Controller
{
    //
    public function AddCart(Request $req, $id){
        $i = 0;
        $sanpham = SanPham::find($id);
        $GioHang = GioHang::where("iduser", $req->id)->get();
        if(count($GioHang)==0){
                $GioHang = new GioHang;
                $GioHang->iduser = $req->id;
                $GioHang->TongSL=0;
                $GioHang->TongGia=0;
                $GioHang->TongTien=0;
                $GioHang->TrangThai=1;
                $GioHang->NgayLap = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i');
                $GioHang->save();
                $i = $this->AddToCart($sanpham, $GioHang);
        }else{
            $i = $this->AddToCart($sanpham, $GioHang[0]);
        }
        if($i==1){
            return response()->json([
                'status' => true,
                'message' => 'Thêm vào giỏ hàng thành công',
                'data' =>null
            ]);
        }
         return response()->json([
                'status' => false,
                'message' => 'Thất bại',
                'data' =>null
            ]);
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
    public function AddToCart($sanpham, $GioHang){
       
        $flag=0;
        $chitietgiohang = ChiTietGioHang::where("MaGH", $GioHang->id)->get();
        if($chitietgiohang){
            $dem = count($chitietgiohang);
            for($i=0;$i<$dem;$i++){
                if($sanpham->id == $chitietgiohang[$i]->MaSP){
                    if( $chitietgiohang[$i]->SoLuong >= 2){
                        return 0;
                    }
                    $flag=1;
                    $SPMoi = $chitietgiohang[$i];
                }
            }
            if($flag==0){
                $SPMoi = new ChiTietGioHang;
                $SPMoi->MaSP = $sanpham->id;
                $SPMoi->Gia = $sanpham->GiaMoi;
                $SPMoi->SoLuong = 0;
                $SPMoi->MaGH = $GioHang->id;
                $SPMoi->save();
                $GioHang->TongSL++;
            }
        }
      
        $SPMoi->SoLuong++;
        $SPMoi->Gia = $SPMoi->SoLuong*$sanpham->GiaMoi;
      
        $SPMoi->update();
        
        $GioHang->TongTien += $sanpham->GiaMoi;
        $GioHang->update();
        return 1;
       
    }
    public function DeleteItemCart(Request $request, $id){
        $sanpham = SanPham::find($request->MaSP);
        $giohang = GioHang::whereiduser($id)->get();
        $chitietgiohang = ChiTietGioHang::where("MaGH", $giohang[0]->id)->get();
        $dem = count($chitietgiohang);
        $tongtien = 0;
        for($i=0;$i<$dem;$i++){
            if($chitietgiohang[$i]->MaSP == $request->MaSP){
                $chitietgiohang[$i]->delete();
                $giohang[0]->TongTien = $tongtien;
                $giohang[0]->TongSL--;
                $giohang[0]->update();
            }else{
            $tongtien+=$chitietgiohang[$i]->Gia; 
            }
        }
        
        return response()->json([
            'status' => 'true',
            'message' => 'Xóa sản phẩm thành công',
            'data' =>null
        ]);
       
    }
    public function getCountProductInCart($id){
        $giohang = GioHang::where("iduser", $id)->get();
        if(count($giohang)>0){
            $chitietgiohang = ChiTietGioHang::where("MaGH", $giohang[0]->id)->get();
            $tongsl = count($chitietgiohang);
        }else{
            $tongsl = 0;
        }
        return response()->json([
            'status' => 'true',
            'message' => '',
    		'data' =>$tongsl
    	]);
    }
    public function getTotalProductInCart($id){
        $giohang = GioHang::where("iduser", $id)->get();
    
        if(count($giohang) > 0){
            $chitietgiohang = ChiTietGioHang::where("MaGH", $giohang[0]->id)->get();
            $dem = count($chitietgiohang);
            for($i=0;$i<$dem;$i++){
                $sanpham = SanPham::find($chitietgiohang[$i]->MaSP);
                $loaisp = LoaiSP::find($sanpham->MaLoai);
                $chitietgiohang[$i]->Gia = $sanpham->GiaMoi;
                $chitietgiohang[$i]->TenSP = $loaisp->TenLoai;
                $chitietgiohang[$i]->HinhAnh1 =Helper::$URL.$sanpham->HinhAnh1;
                $chitietgiohang[$i]->MauSac = $sanpham->MauSac;
                $chitietgiohang[$i]->DungLuong = $sanpham->DungLuong;
            }
            return response()->json([
                'status' => 'true',
                'message' => '',
                'data' =>([ 'TongTien' => $giohang[0]->TongTien,
                            'CTGH'=> $chitietgiohang 
                    ])

            ]);
        }
        return response()->json([
            'status' => 'true',
            'message' => 'Giỏ hàng rỗng',
            'data' =>null
        ]);
    }
    public function updateCart(Request $request, $id){
        $sanpham = SanPham::find($request->MaSP);
        $giohang = GioHang::whereiduser($id)->get();
        
        $chitietgiohang = ChiTietGioHang::where("MaGH", $giohang[0]->id)->get();
        $dem = count($chitietgiohang);
        $tongtien = 0;
        for($i=0;$i<$dem;$i++){
            if($chitietgiohang[$i]->MaSP == $request->MaSP){
                $chitietgiohang[$i]->SoLuong = $request->SoLuong;
                $chitietgiohang[$i]->Gia = $chitietgiohang[$i]->SoLuong*$sanpham->Gia;
                $chitietgiohang[$i]->update();
            }
            $tongtien+=$chitietgiohang[$i]->Gia; 
        }
        $giohang[0]->TongTien = $tongtien;
        $giohang[0]->update();
        return response()->json([
            'status' => 'true',
            'message' => 'Cập nhật thành công',
            'data' =>null
        ]);
    }
    public function postBillandDetailBill($id)
    { 
        $giohang = GioHang::where("iduser", $id)->get();
        $donhang = new DonHang();
        $user = User::find($id);
        $donhang->iduser = $id;
        $donhang->SDT =  $user->SDT;
        $donhang->DiaChi =  $user->DiaChi;
        $donhang->ThanhTien =  request('totalMoney');
        $donhang->TrangThaiDH ="Đã tiếp nhận";
        $donhang->TrangThai = 1;
        $donhang->NgayLap = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i');
        $donhang->save();
        $dem = count(request('listProduct'));
        for($i=0;$i<$dem;$i++){
            $chitietdonhang = new ChiTietdonhang();
            $chitietdonhang->MaDH =  $donhang->id;
            $chitietdonhang->MaSP = request('listProduct')[$i]['MaSP'];
            $chitietdonhang->SoLuong = request('listProduct')[$i]['SoLuong'];
            $chitietdonhang->Gia = request('listProduct')[$i]['Gia'];
            $chitietdonhang->save();
        }
        if(count($giohang)>0){
            $giohang[0]->delete();
            $chitietgiohang = ChiTietGioHang::where("MaGH", $giohang[0]->id)->delete();
        }
        $thongbao = new ThongBao();
        $thongbao->iduser = $id;
        $thongbao->tieude = "Đã tiếp nhận đơn hàng #".$donhang->id;
        $thongbao->noidung = "Chúng tôi sẽ gọi cho ".$user->name." để xác nhận trong thời gian sớm nhất";
        $thongbao->trangthai = 0;
        $thongbao->ngaylap = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i');
        $thongbao->save();
        return response()->json([
            'status' => 'true',
            'message' => 'Đặt hàng thành công',
            'data' =>null
        ]);
        
    }
    public function getOrder($id, Request $request){
        $donhang = DonHang::whereiduser($id)->get();
        if(count($donhang)>0){   
            if($request->state == "all"){
                $size = count($donhang);
                for($i=0;$i<$size;$i++){
                $chitietdonhang = ChiTietDonHang::wheremadh($donhang[$i]->id)->get();
                $slSP = count($chitietdonhang);
                $donhang[$i]->SoLuongSP = $slSP;
                }
                return response()->json([
                    'status' => 'true',
                    'message' => '',
                    'data' =>$donhang
                ]);
            }else{
                $donhang = DonHang::whereiduser($id)->wheretrangthaidh($request->state)->get();
               $size = count($donhang);
                for($i=0;$i<$size;$i++){
                    $chitietdonhang = ChiTietDonHang::wheremadh($donhang[$i]->id)->get();
                    $slSP = count($chitietdonhang);
                    $donhang[$i]->SoLuongSP = $slSP;
                    }
                return response()->json([
                    'status' => 'true',
                    'message' => '',
                    'data' =>$donhang
                ]);
            }
        }
        return response()->json([
            'status' => 'false',
            'message' => '',
            'data' =>null
        ]);
    }
    public function getDetailOrder($id){
        $chitietdonhang = ChiTietDonHang::wheremadh($id)->get();
        $donhang = DonHang::find($id);
        $size = count($chitietdonhang);
        $detailOrder = [];
        $product =[];
        $detail = new DetailCart();
        for($i=0;$i<$size;$i++){
            $sanpham = SanPham::find($chitietdonhang[$i]->MaSP);
            $loaisanpham = LoaiSP::find($sanpham->MaLoai);
            $sanpham->TenSP = $loaisanpham->TenLoai;
            $sanpham->HinhAnh1 = Helper::$URL.$sanpham->HinhAnh1;
            $qty = $chitietdonhang[$i]->SoLuong;
            $total = $donhang->ThanhTien;
            array_push($detailOrder, (["product"=>$sanpham,"qty"=>$qty,"total"=>$total]));
        }
        return response()->json([
            'status' => 'true',
            'message' => '',
            'data' =>$detailOrder
        ]);
    }
    public function cancelOrder($id){
        $donhang = DonHang::find($id);
        $donhang->TrangThaiDH = "Đã hủy";
        $donhang->update();
        return response()->json([
            'status' => 'true',
            'message' => 'Update thành công',
            'data' =>null
        ]);
    }
    
}