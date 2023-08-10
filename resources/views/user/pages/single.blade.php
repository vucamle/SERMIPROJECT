@extends('user.layout')
@section('content')
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Chi Tiết Sản Phẩm</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Sản Phẩm</a></li>
                    <li class="breadcrumb-item active">Chi Tiết Sản Phẩm </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Shop Detail  -->
<div class="shop-detail-box-main">
    <div class="container">
        @foreach($sanpham as $sanpham)
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active"> <img class="d-block w-100"
                                src="{!! asset('image/'.$sanpham->Image1)!!}" alt="First slide"> </div>
                        <div class="carousel-item"> <img class="d-block w-100"
                                src="{!! asset('image/'.$sanpham->Image2)!!}" alt="Second slide"> </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                        <span class="sr-only">Trở Lại</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                        <span class="sr-only">Tiếp Tục</span>
                    </a>

                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-6">
                <div class="single-product-details">
                    <h2>{{$sanpham->TenSP}}</h2>
                    <h5> <del>{{number_format($sanpham->Gia),2}} VND</del> {{number_format($sanpham->GiaMoi),2}} VND</h5>
                    <p class="available-stock"><span> Hơn {{$sanpham->SoLuong}} sản phẩm có sẵn trong kho! </span>
                    <p>
                    <h4>Mô Tả:</h4>
                    <p>{{$sanpham->Mota}} </p>
                    <ul>
                        <li>
                            <div class="form-group quantity-box">
                                <label class="control-label">Số Lượng</label>
                                <input class="form-control" value="0" min="0" max="20" type="number">
                            </div>
                        </li>
                    </ul>

                    <div class="price-box-bar">
                        <div class="cart-and-bay-btn">
                            <a class="btn hvr-hover"  data-fancybox-close="" href="{{route('user.shop')}}">Xem sản phẩm khác</a>
                            <a class="btn hvr-hover" data-fancybox-close="" onclick="AddtoCart({{$sanpham->id}})" href="javascript:">Thêm vào giỏ</a>
                        </div>
                    </div>

                    <div class="add-to-btn">

                        <div class="share-bar">
                            <a class="btn hvr-hover" target="_blank" href="http://fb.com/mtiendat"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="row my-5">
            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    <h2>Bình Luận</h2>
                </div>
                
                    <div class="card-body">
                    <div id="binhluan">
                        @foreach($binhluan as $preview)
                        <div class="media mb-3">
                            <div class="mr-2">
                                <small class="text-muted">{{$preview->name}}</small>
                            </div>
                            <div class="media-body">
                                <p>{{$preview->noidung}}</p>
                                <small class="text-muted">{{$preview->ngaydang}}</small>
                            </div>
                        </div>
                     
                        <hr>
                        @endforeach
                        </div>

                        @if(session()->has('infoUser'))
                        <?php $infoUser =session()->get('infoUser') ?>
                        <form id="myComment">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name" class="mb-0">Tên: </label>
                                    <input type="text" readonly name="name" class="form-control" id="inputname"
                                        value="{{$infoUser['name']}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="noidung" class="mb-0">Nội dung: </label>
                                    <input type="text" name="noidung" class="form-control" id="inputcontent"
                                        placeholder="Input Your Review"> </div>
                            </div>
                            <input type="text" name="id_user" hidden class="form-control" id="inputid_user"
                                value="{{$infoUser['id']}}">
                            <input type="text" name="id_sanpham" hidden class="form-control" id="inputid_sanpham"
                                value="{{$sanpham->id}}">
                            <input type="text" name="trangthai" hidden class="form-control" id="inputtrangthai"
                                value="1">
                            <input type="text" name="ngaydang" hidden class="form-control" id="inputngaydang"
                                value="{{$date->toDayDateTimeString()}}">
                            <button type="submit" class="btn hvr-hover" id="submit">Gửi</button>
                        </form>
                        @else
                        <a href="{{route('getLogin')}}" class="btn hvr-hover">Vui lòng đăng nhập để bình luận</a>
                        @endif
                    </div>
                <div>
                    </div>
                </div>
        </div>
    </div>
</div>

                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="title-all text-center">
                            <h1>Sản Phẩm Nổi Bật</h1>
                            <p></p>
                        </div>
                        <div class="featured-products-box owl-carousel owl-theme">
                            @foreach($futuredproducts as $sanpham)
                            <div class="item">
                                <div class="products-single fix">
                                    <div class="box-img-hover">
                                        <img src="{!! asset('image/'.$sanpham->Image1)!!}" class="img-fluid"
                                            alt="Image">
                                        <div class="mask-icon">
                                            <ul>
                                                <li><a href="#" data-toggle="tooltip" data-placement="right"
                                                        title="View"><i class="fas fa-eye"></i></a></li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="right"
                                                        title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="right"
                                                        title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                            </ul>
                                            <a class="cart" href="#">Thêm vào giỏ</a>
                                        </div>
                                    </div>
                                    <div class="why-text">
                                        <h4>{{$sanpham->TenSP}}</h4>
                                        <h5> {{$sanpham->GiaMoi}} VND</h5>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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