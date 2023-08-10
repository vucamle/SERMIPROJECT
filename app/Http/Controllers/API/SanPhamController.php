<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\LoaiSP;
use App\Models\User;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use App\Models\DanhGia;
use App\Models\DanhGiaReply;
use App\Models\SlideShow;
use App\Models\NhaCungCap;
use App\Classes\Helper;
use Illuminate\Support\Collection;
use Carbon\Carbon;
class SanPhamController extends Controller
{
    public function getSlideShow(){
        $slide = SlideShow::all();
        $size = count($slide);
        for($i=0;$i<$size;$i++){
            $slide[$i]->HinhAnh = Helper::$URL.$slide[$i]->HinhAnh;
        }
        return response()->json([
            'status' => 'true',
            'message' => '',
    		'data' => $slide
    	]);
    }
    public function getCateProduct(Request $request){
        $page = !empty($request->page) ? $request->page : 1;
    	$itemsPerPage = !empty($request->items_per_page) ? $request->items_per_page : 5;
        $dsLoaiSP = LoaiSP::orderBy('id',"desc")->skip(($page - 1) * $itemsPerPage)->take($itemsPerPage)->get();
        $dem =count($dsLoaiSP);
        for($i=0;$i<$dem;$i++){
        $sanpham = SanPham::where('MaLoai', $dsLoaiSP[$i]->id)->get();
        $dsLoaiSP[$i]->Gia = $sanpham[0]->Gia;
        $dsLoaiSP[$i]->GiaMoi = $sanpham[0]->GiaMoi;
         $dsLoaiSP[$i]->AnhDaiDien=Helper::$URL.$dsLoaiSP[$i]->AnhDaiDien;
        }
        if($request->order=="0"){
            $dsLoaiSP = $dsLoaiSP ->sortBy('GiaMoi')->values();
            
        }else if($request->order=="1"){
            $dsLoaiSP = $dsLoaiSP ->sortByDesc('GiaMoi')->values();
        }
        return response()->json([
            'status' => 'true',
            'message' => '',
    		'data' => $dsLoaiSP
    	]); 
    }
    public function getCateProductByNCC(Request $request){
        $page = !empty($request->page) ? $request->page : 1;
    	$itemsPerPage = !empty($request->items_per_page) ? $request->items_per_page : 5;
        $dsLoaiSP = LoaiSP::wheremancc($request->MaNCC)->skip(($page - 1) * $itemsPerPage)->take($itemsPerPage)->get();
        $dem =count($dsLoaiSP);
        for($i=0;$i<$dem;$i++){
        $sanpham = SanPham::where('MaLoai', $dsLoaiSP[$i]->id)->get();
        $dsLoaiSP[$i]->Gia = $sanpham[0]->Gia;
        $dsLoaiSP[$i]->GiaMoi = $sanpham[0]->GiaMoi;
         $dsLoaiSP[$i]->AnhDaiDien=Helper::$URL.$dsLoaiSP[$i]->AnhDaiDien;
        }
        return response()->json([
            'status' => 'true',
            'message' => '',
    		'data' => $dsLoaiSP
    	]);
    }
    public function getTopCateProductByNCC(Request $request){
        $dsLoaiSP = LoaiSP::orderBy("id", "desc")->wheremancc($request->MaNCC) ->limit(5)->get();
        $dem =count($dsLoaiSP);
        for($i=0;$i<$dem;$i++){
        $sanpham = SanPham::where('MaLoai', $dsLoaiSP[$i]->id)->get();
        $dsLoaiSP[$i]->Gia = $sanpham[0]->Gia;
        $dsLoaiSP[$i]->GiaMoi = $sanpham[0]->GiaMoi;
         $dsLoaiSP[$i]->AnhDaiDien=Helper::$URL.$dsLoaiSP[$i]->AnhDaiDien;
        }
        return response()->json([
            'status' => 'true',
            'message' => '',
    		'data' => $dsLoaiSP
    	]);
    }
    public function getAllProduct(){
        $listProducts = SanPham::all();
        $dem =count($listProducts);
        for($i=0;$i<$dem;$i++){
         $cateProducts = LoaiSP::find($listProducts[$i]->MaLoai);
         $listProducts[$i]->TenSP = $cateProducts->TenLoai;
         $listProducts[$i]->Vote = $cateProducts->Vote;
         $listProducts[$i]->HinhAnh1=Helper::$URL.$listProducts[$i]->HinhAnh1;
         $listProducts[$i]->HinhAnh2=Helper::$URL.$listProducts[$i]->HinhAnh2;
        }
        return response()->json([
            'status' => 'true',
            'message' => '',
    		'data' => $listProducts
    	]);
    }
    public function getDanhMucSanPham(Request $request){
        $dsSanPham = SanPham::where('DanhMuc', $request->danhmuc)->limit(5)->get();
        $dem =count($dsSanPham);
        for($i=0;$i<$dem;$i++){
        $thuocLoai = LoaiSP::find($dsSanPham[$i]->MaLoai);
        $dsSanPham[$i]->TenSP = $thuocLoai->TenLoai." ".$dsSanPham[$i]->DungLuong;
         $dsSanPham[$i]->HinhAnh1=Helper::$URL.$dsSanPham[$i]->HinhAnh1;
         $dsSanPham[$i]->HinhAnh2=Helper::$URL.$dsSanPham[$i]->HinhAnh2;
        }
        return response()->json([
            'status' => 'true',
            'message' => '',
    		'data' => $dsSanPham
    	]);
    }
    public function getNhaCungCap(){
        $nhaCungCap = NhaCungCap::all();
        $dem =count($nhaCungCap);
        for($i=0;$i<$dem;$i++){
         $nhaCungCap[$i]->logo=Helper::$URL.$nhaCungCap[$i]->logo;
        }
        return response()->json([
            'status' => 'true',
            'message' => '',
    		'data' => $nhaCungCap
    	]);
    }
    public function checkArray(array $array, String $string){
        $dem = count($array);
        for($i=0;$i<$dem;$i++){
            if($array[$i] == $string){
                return false;
            }
        }
        return true;
    }
    
    public function getCateSanPhamByID($id){
        $color = array();
        array_push($color, "M.Sắc");
        $storage = array();
        array_push($storage, "D.Lượng");
        $loai = LoaiSP::find($id);
        $sanpham = SanPham::where("MaLoai", $id)->get();
        $nhacungcap = NhaCungCap::find($loai->MaNCC);
        $nhacungcap->logo = Helper::$URL.$nhacungcap->logo;
        $loai->Gia = $sanpham[0]->Gia;
        $loai->GiaMoi = $sanpham[0]->GiaMoi;
        $loai->NhaCungCap = $nhacungcap;
        $loai->AnhDaiDien = Helper::$URL.$loai->AnhDaiDien;
        $dem = count($sanpham);
        for($i=0;$i<$dem;$i++){
           
            if($this->checkArray($color, $sanpham[$i]->MauSac)){
                array_push($color, $sanpham[$i]->MauSac);
            }
          if($this->checkArray($storage,$sanpham[$i]->DungLuong)){
           array_push($storage, $sanpham[$i]->DungLuong);
         }
        }
        $loai->MauSac = $color;
        $loai->DungLuong = $storage;
        return response()->json([
            'status' => 'true',
            'message' => '',
    		'data' => $loai
    	]);
        
    }
    public function getSanPhamByID($id, Request $request){
        if(!empty($request->MauSac) && !empty($request->DungLuong)){
            $sanpham = SanPham::where("MaLoai", $id)->where("MauSac","like",$request->MauSac)->where("DungLuong",$request->DungLuong)->get();
            $dem = count($sanpham);
            for($i=0;$i<$dem;$i++){
                $sanpham[$i]->HinhAnh1=Helper::$URL.$sanpham[$i]->HinhAnh1;
               }
            
        }else if(!empty($request->MauSac)){
            $sanpham = SanPham::where("MaLoai",$id)->where("MauSac","like",$request->MauSac)->get();
            $dem = count($sanpham);
            for($i=0;$i<$dem;$i++){
                $sanpham[$i]->HinhAnh1=Helper::$URL.$sanpham[$i]->HinhAnh1;
            }
        }else if(!empty($request->DungLuong)){
            $sanpham = SanPham::where("MaLoai", $id)->where("DungLuong",$request->DungLuong)->get();
            $dem = count($sanpham);
            for($i=0;$i<$dem;$i++){
                $sanpham[$i]->HinhAnh1=Helper::$URL.$sanpham[$i]->HinhAnh1;
               }
           
        }
        return response()->json([
            'status' => 'true',
            'message' => '',
            'data' => $sanpham
        ]);
    }
    public function getSanPhamLienQuan($id){
        $SPLienQuan = LoaiSP::find($id);
        $dsSanPhamLQ = LoaiSP::where("MaNCC", $SPLienQuan->MaNCC)->limit(5)->get();
        $dem =count($dsSanPhamLQ);
        for($i=0;$i<$dem;$i++){
        $sanpham = SanPham::where('MaLoai', $dsSanPhamLQ[$i]->id)->get();
        $dsSanPhamLQ[$i]->Gia = $sanpham[0]->Gia;
        $dsSanPhamLQ[$i]->GiaMoi = $sanpham[0]->GiaMoi;
         $dsSanPhamLQ[$i]->AnhDaiDien=Helper::$URL.$dsSanPhamLQ[$i]->AnhDaiDien;
        }
        return response()->json([
            'status' => 'true',
            'message' => '',
    		'data' => $dsSanPhamLQ
    	]);
    } 
    public function getDanhGia(Request $request, $id){
        if($request->all == "true"){
            $dsDanhGia = DanhGia::where("id_sp", $id)->get();
            $sanpham = SanPham::wheremaloai($id)->get();
            $size = count($dsDanhGia);
            for($i=0;$i<$size;$i++){
                $user = User::find($dsDanhGia[$i]->id_user);
                if($user->HinhThuc==="Facebook"){
                    $dsDanhGia[$i]->avatar_user =$user->avatar;
                    
                }else{
                    $dsDanhGia[$i]->avatar_user =Helper::$URL.$user->avatar;
                }
        
                $dsDanhGia[$i]->name =  $user->name;
            }
            return response()->json([
                'status' => 'true',
                'message' => 'true',
                'data' =>$dsDanhGia
            ]);
        }
                $dsDanhGia = DanhGia::where("id_sp", $id)->limit(5)->get();
                $sanpham = SanPham::wheremaloai($id)->get();
                $size = count($dsDanhGia);
                for($i=0;$i<$size;$i++){
                    $user = User::find($dsDanhGia[$i]->id_user);
                    if($user->HinhThuc==="Facebook"){
                        $dsDanhGia[$i]->avatar_user =$user->avatar;
                        
                    }else{
                        $dsDanhGia[$i]->avatar_user =Helper::$URL.$user->avatar;
                    }
                    $dsDanhGia[$i]->name =  $user->name;
                }
                $donhang = DonHang::where("iduser", $request->idUser)->get();
                $dem = count($donhang);
                if($dem==0){
                    return response()->json([
                        'status' => 'true',
                        'message' => 'false',
                        'data' =>$dsDanhGia
                    ]);
                }else{
                    $s = count($sanpham);
                    for($i=0;$i<$dem;$i++){
                        $chitietdonhang = ChiTietDonHang::where("MaDH", $donhang[$i]->id)->get();
                        $d = count($chitietdonhang);
                        for($j=0;$j<$d;$j++){
                                for($z=0;$z<$s;$z++){
                                    if($chitietdonhang[$j]->MaSP == $sanpham[$z]->id){
                                        if($donhang[$i]->TrangThaiDH=="Đã giao hàng"){
                                        return response()->json([
                                            'status' => 'true',
                                            'message' => 'true',
                                            'data' =>$dsDanhGia
                                        ]);
                                        }
                                    }
                            }
                        }
                    }     
            }
            return response()->json([
                'status' => 'true',
                'message' => 'false',
                'data' =>$dsDanhGia
            ]); 
        

    }
    public function postDanhGia($id){
        $newDanhGia = new DanhGia();
        $newDanhGia->id_sp = $id;
        $newDanhGia->id_user = request('id_user');
        $newDanhGia->noidung= request('noidung');
        $newDanhGia->danhgia = request('danhgia');
        $newDanhGia->ngaylap = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i');
        $newDanhGia->save();
        $dsDanhGia = DanhGia::where("id_sp", $id)->get();
        $loaiSP = LoaiSP::find($id);
        $size = count($dsDanhGia);
        $tongVote = 0;
        for($i=0;$i<$size;$i++){
            $tongVote+= $dsDanhGia[$i]->danhgia; 
        }
        $loaiSP->Vote = $tongVote/$size;
        $loaiSP->update();
        return response()->json([
            'status' => 'true',
            'message' => 'Đánh giá thành công',
            'data' =>null
        ]);

    }
    public function getDanhGia2($id){
        $danhgia = DanhGia::where("id_sp", $id)->get();
        for($i=0;$i<count($danhgia);$i++){
            $reply = DanhGiaReply::where("id_dg",$danhgia[$i]->id)->get();
            $danhgia[$i]->reply = $reply;
        }
        return $danhgia;
    }
    
}
