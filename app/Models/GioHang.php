<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChiTietGioHang;
use App\Models\GioHang;
class GioHang extends Model
{
    use HasFactory;
    protected $table='giohang';
    protected $fillable =[
        'id',
        'iduser',
        'TongSL',
        'TongGia',
        'TongTien',
        'TrangThai'
    ];
    public $products = null;
	public $totalQuantity = 0;
	public $totalPrice = 0;
   
    public function AddCart($product, $newcart){
        //$newProduct=['quantity'=>0,'price'=>$product->GiaMoi,'productInfo'=>$product];
       $flag=0;
        $chitietgiohang = ChiTietGioHang::where("MaGH", $newcart->id)->get();
        if($chitietgiohang){
            $dem = count($chitietgiohang);
            for($i=0;$i<$dem;$i++){
                if($product->id == $chitietgiohang[$i]->MaSP){
                    $flag=1;
                    $SPMoi = $chitietgiohang[$i]->MaSP;
                }
            }
            if($flag==0){
                $SPMoi = new ChiTietGioHang;
                $SPMoi->MaSP = $product->id;
                $SPMoi->Gia = $product->GiaMoi;
                $SPMoi->SoLuong = 1;
                $SPMoi->MaGH = $newcart->id;
                $SPMoi->save();
            }
        }
        // if($this->products){
        //     if(array_key_exists($id,$this->products)){
        //         $newProduct=$this->products[$id];//neusp đã tồn tại trong mảng
        //     }
        // }
        $SPMoi->SoLuong++;
        $SPMoi->Gia = $SPMoi->SoLuong*$product->GiaMoi;
        // $newProduct['quantity']++;
        // $newProduct['price']=$newProduct['quantity']*$product->GiaMoi;
        $SPMoi->update();
        $newcart->TongSL++;
        $newcart->TongTien += $SPMoi->Gia;
        $newcart->update();
        // $this->products[$id] = $newProduct;
        // $this->totalPrice+=$product->GiaMoi;
        // $this->totalQuantity++;
    }
    public function DeleteItemCart($id){
        $this->totalQuantity -= $this->products[$id]['quantity']; //- số luong của sp có id trong dsach products
        $this->totalPrice -= $this->products[$id]['price'];//- giá của sp có id trong dsach products
        unset($this->products[$id]); 
    }
}
