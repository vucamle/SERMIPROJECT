@extends('user.layout')
@section('content')
<div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Thanh Toán</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Thanh Toán</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Chi Tiết Hóa Đơn</h3>
                        </div>
                        @if (session('status'))
                    <ul>
                        <li class="text-success"> {{ session('status') }}</li>
                    </ul>
                @endif
                        <form action="{{route('postBillandDetail')}}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">Họ và tên: </label>
                                    <input type="text" class="form-control" name="hoten" id="firstName" placeholder="" value="" required>
                                    <div class="invalid-feedback"> Valid first name is required. </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">SDT: </label>
                                    <input type="text" class="form-control" name="sdt" id="lastName" placeholder="" value="" required>
                                   
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Địa chỉ: </label>
                                <input type="text" class="form-control" name="diachi" id="address" placeholder="" required>
                    
                                <input type="text" class="form-control" hidden name="id_user" value="{{session()->get('infoUser')['id']}}" required>
                            </div>
                            <hr class="mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="same-address">
                                <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                            </div>
                            <hr class="mb-4">
                            <div class="title"> <span>Phương thức thanh toán</span> </div>
                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                                    <label class="custom-control-label" for="credit">Thanh toán khi nhận hàng</label>
                                </div>
                            </div>
                            <div>
                            <?php //NỐI CHUỖI(TÊN SẢN PHẨM, SỐ LƯỢNG, GIÁ)
                            $dstensp=""; 
                            $dsgia="VND";
                            $dssoluong="";
                            $size= count($dssanpham->products);
                            $i=1;
                            foreach($dssanpham->products as $product)     
                            {  if($i==$size)
                               {
                                $dstensp=$dstensp.$product['productInfo']->TenSP;
                                $dsgia=$product['productInfo']->GiaMoi. $dsgia;
                                $dssoluong=$dssoluong.$product['quantity'];
                                }
                                else{
                                $dstensp=$dstensp.$product['productInfo']->TenSP.", ";
                                $dsgia=$product['productInfo']->GiaMoi. $dsgia."/";
                                $dssoluong=$dssoluong.$product['quantity']."/";
                                $i++;
                               }
                            }   
                            ?>
                            <input type="text" hidden name="dstensp" value="{{$dstensp}}"/>
                            <input type="text" hidden name="dsgia" value="{{$dsgia}}"/>
                            <input type="text" hidden name="dssoluong" value="{{$dssoluong}}"/>
                            <input type="text" hidden name="thanhtien" value="{{$dssanpham->totalPrice}}"/>
                            <input type="text" hidden name="id_user" value="{{session()->get('infoUser')['id']}}"/>
                            </div>
                            <hr class="mb-1"> 
                        
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                       
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Danh sách sản phẩm</h3>
                                </div>
                                <div class="rounded p-2 bg-light">
                                @foreach($dssanpham->products as $product)
                                    <div class="media mb-2 border-bottom">
                                        <div class="media-body"> <a href="detail.html">{{$product['productInfo']->TenSP}}</a>
                                            <div class="small text-muted">{{$product['productInfo']->GiaMoi}} VND<span class="mx-2">|</span> SL: {{$product['quantity']}}<span class="mx-2">|</span> Tổng tiền: {{$product['price']}} VND</div>
                                        </div>
                                    </div>
                                    @endforeach
                
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Đơn hàng của bạn</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Sản Phẩm</div>
                                    <div class="ml-auto font-weight-bold">Tổng</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Tổng</h4>
                                    <div class="ml-auto font-weight-bold"> {{$dssanpham->totalPrice}} VND</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Phí vận chuyển</h4>
                                    <div class="ml-auto font-weight-bold"> Free </div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Tổng tiền</h5>
                                    <div class="ml-auto h5"> {{$dssanpham->totalPrice}} VND</div>
                                </div>
                                <hr> </div>
                        </div>
                        <div class="col-12 d-flex shopping-box"> 
                        <button type="submit" class="ml-auto btn hvr-hover">Đặt hàng</a> </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

    <!-- Start Instagram Feed  -->
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-01.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-02.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-03.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-04.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-05.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-06.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-07.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-08.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-09.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-05.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Instagram Feed  -->
@stop