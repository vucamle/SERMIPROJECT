@extends('user.layout')
@section('content')
<div id="slides-shop" class="cover-slides">
        @if(session()->has('status'))
                <div class="alert alert-success">{{session()->get('status')}}</div>
            @endif
        <ul class="slides-container">
            <li class="text-center">
                <img src="{!! asset('user/images/banner-01.jpg') !!}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Chào mừng bạn đến với <br> Freshshop</strong></h1>
                            <p class="m-b-40">Nơi cung cấp những nguồn sản phẩm chính hãng <br>sạch</p>
                            <p><a class="btn hvr-hover" href="{{route('user.shop')}}">Mua ngay</a></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="{!! asset('user/images/banner-02.jpg') !!}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Chào mừng bạn đến với <br> Freshshop</strong></h1>
                            <p class="m-b-40">Đạt tiêu chuẩn<br> kiểm định</p>
                            <p><a class="btn hvr-hover" href="{{route('user.shop')}}">Mua ngay</a></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="{!! asset('user/images/banner-03.jpg') !!}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Chào mừng bạn đến với <br> Freshshop</strong></h1>
                            <p class="m-b-40">Đạt chất lượng <br>quốc tế</p>
                            <p><a class="btn hvr-hover" href="{{route('user.shop')}}">Mua Ngay</a></p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->

    <!-- Start Categories  -->
    <div class="categories-shop">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="shop-cat-box">
                        <img class="img-fluid" src="{!! asset('user/images/categories_img_01.jpg') !!}" alt="" />
                        <a class="btn hvr-hover" href="#">Nguồn gốc rõ ràng</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="shop-cat-box">
                        <img class="img-fluid" src="{!! asset('user/images/categories_img_02.jpg') !!}" alt="" />
                        <a class="btn hvr-hover" href="#">Tươi đạt chuẩn organic</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="shop-cat-box">
                        <img class="img-fluid" src="{!! asset('user/images/categories_img_03.jpg') !!}" alt="" />
                        <a class="btn hvr-hover" href="#">Bảo quản tốt</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Categories -->
	
	<div class="box-add-products">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="offer-box-products">
						<img class="img-fluid" src="{!! asset('user/images/o1.jpg') !!}" alt="" />
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="offer-box-products">
						<img class="img-fluid" src="{!! asset('user/images/o2.jpg') !!}" alt="" />
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- Start Products  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Trái cây & Rau củ</h1>
                        <p>Trái cây & Rau củ là nguồn quan trọng của nhiều chất dinh dưỡng, bao gồm kali, chất xơ, folate (axit folic), vitamin A và vitamin C.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">Tất cả</button>
                            <button data-filter=".top-featured">Top hàng đầu</button>
                            <button data-filter=".best-seller">Đang giảm giá</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row special-list">
            @foreach($topfuture as $sanpham)
                <div class="col-lg-3 col-md-6 special-grid best-seller">
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <div class="type-lb">
                                <p class="sale">Mới</p>
                            </div>
                            <a href="{{route('user.single',$sanpham->id)}}"><img src="{!! asset('image/'.$sanpham->Image1)!!}" class="img-fluid" alt="Image"></a>
                            <div class="mask-icon">
                                <ul>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                   
                                </ul>
                                <a class="cart" onClick="AddCart({{$sanpham->id}})" href="javascript:">Thêm vào giỏ</a>
                            </div>
                        </div>
                        <div class="why-text">
                            <h4><a href="{{route('user.single',$sanpham->id)}}">{{$sanpham->TenSP}}</a></h4>
                            <h5>{{number_format($sanpham->GiaMoi),2}} VND</h5>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach($bestseller as $sanpham)
                <div class="col-lg-3 col-md-6 special-grid top-featured">
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <div class="type-lb">
                                <p class="sale">Giảm giá</p>
                            </div>
                            <a href="{{route('user.single',$sanpham->id)}}"><img src="{!! asset('image/'.$sanpham->Image1)!!}" class="img-fluid" alt="Image"></a>
                            <div class="mask-icon">
                                <ul>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
       
                                </ul>
                                <a class="cart" onClick="AddCart({{$sanpham->id}})" href="javascript:">Thêm vào giỏ</a>
                            </div>
                        </div>
                        <div class="why-text">
                        <h4><a href="{{route('user.single',$sanpham->id)}}">{{$sanpham->TenSP}}</a></h4>
                            <h5>{{number_format($sanpham->GiaMoi),2}} VND</h5>
                        </div>
                    </div>
                </div>
            @endforeach
                
            </div>
        </div>
    </div>
    <!-- End Products  -->

    <!-- Start Blog  -->
    <div class="latest-blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Blog mới nhất</h1>
                        <p>Đến từ các trang trại hữu cơ. Mang đến cho mọi người cuộc sống xanh sạch đẹp</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="{!! asset('user/images/blog-img.jpg') !!}" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                            <h3>Bắp cải xanh</h3>
                                <p>Bắp cải xanh - Vua của các loại cải và người bạn cũ của chúng ta! Các lá rộng hình quạt có màu xanh lục nhạt và có kết cấu hơi cao su khi còn nguyên. Chọn những đầu thắt chặt và cảm thấy nặng so với kích thước của chúng. Một vài lớp bên ngoài thường bị héo và nên bỏ đi trước khi chuẩn bị. Bắp cải xanh thái lát mỏng có thể ăn sống hoặc chế biến thành món xào, súp và om. Toàn bộ lá cũng có thể được sử dụng để làm bắp cải cuộn. Lá thô có hương vị hơi thơm, nhưng bắp cải ngọt hơn khi nấu chín.</p>
                            </div>
                         
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="{!! asset('user/images/blog-img-02.jpg') !!}" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>Cà rốt</h3>
                                <p>Cà rốt là loại rau củ được trồng lần đầu tiên ở Afghanistan vào khoảng năm 900 sau Công nguyên. Màu cam có thể là màu nổi tiếng nhất của chúng, nhưng chúng cũng có các màu khác, bao gồm tím, vàng, đỏ và trắng. Cà rốt ban đầu có màu tím hoặc vàng. Cà rốt màu cam được phát triển ở Trung Âu vào khoảng thế kỷ 15 hoặc 16. Loại rau phổ biến và đa năng này có thể có mùi vị hơi khác nhau tùy thuộc vào màu sắc, kích thước và nơi nó được trồng. Đường trong cà rốt mang lại cho chúng một hương vị hơi ngọt, nhưng chúng cũng có thể có vị chua hoặc đắng.</p>
                            </div>
                          
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="{!! asset('user/images/blog-img-01.jpg') !!}" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>Lợi ích của rau củ</h3>
                                <p>Tại sao bạn nên chọn chế độ ăn nhiều rau củ?</p>
                                <p>Ăn rau mang lại lợi ích cho sức khỏe - những người ăn nhiều rau và trái cây như một phần của chế độ ăn uống lành mạnh tổng thể có khả năng giảm nguy cơ mắc một số bệnh mãn tính. Rau cung cấp các chất dinh dưỡng quan trọng cho sức khỏe và duy trì cơ thể của bạn.</p>
                                <p>Lợi ích cho sức khỏe</p>
                                <p>Là một phần của chế độ ăn uống lành mạnh tổng thể, ăn các loại thực phẩm như rau có hàm lượng calo thấp hơn trong mỗi cốc thay vì một số thực phẩm khác có lượng calo cao hơn có thể hữu ích trong việc giúp giảm lượng calo nạp vào.</p>
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog  -->


    <!-- Start Instagram Feed  -->
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            @foreach($allimagesp as $images)
            <div class="item">
                <div class="ins-inner-box">
                    <img class="img-thumbnail" style="width:250px;height:250px" src="{!! asset('image/'.$images->Image1)!!}" alt="" />
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- End Instagram Feed  -->
    @stop