<div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="custom-select-box">
                        <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
							<option>VND</option>
							</select>
                    </div>
                    <div class="right-phone-box">
                        <p>Gọi cho chúng tôi :- <a href="#"> +84 xxxxxxx01</a></p>
                    </div>
                    <div class="our-link">
                        <ul>
                        @if(session()->has('infoUser'))
                            <li><a href="{{route('myAccount')}}"><i class="fa fa-user s_color"></i><?php $infoUser =session()->get('infoUser') ?>{{$infoUser['name']}}</a></li>
                            <li><a href="{{route('myBill',$infoUser['id'])}}"><i class="fa fa-user s_color"></i>Hóa Đơn</a></li>
                        @else
                        <li><a href="{{route('getLogin')}}"><i class="fa fa-user s_color"></i>Đăng Nhập</a></li>
                        @endif
                            <li><a href="{{ route('getLogout') }}"><i class="fas fa-location-arrow"></i>Đăng Xuất</a></li>
            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					
                    <div class="text-slid-box">
                        <div id="offer-box" class="carouselTicker">
                            <ul class="offer-box">
                                <li>
                                    <i class="fab fa-opencart"></i> Miễn phí vận chuyển!
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Rau củ giảm 50% - 80%
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href="{{route('user.index')}}"><img src="{!! asset('user/images/logo.png') !!}" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item"><a class="nav-link" href="{{route('user.index')}}">Trang chủ</a></li>
            
                        <li class="dropdown">
                            <a href="{{route('user.shop')}}" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">SHOP</a>
                            <ul class="dropdown-menu">
                            <li><a href="{{route('user.shop')}}">Sản Phẩm</a></li>
                                <li><a href="{{route('user.cart')}}">Xem giỏ Hàng</a></li>
                        
                
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{route('user.gallery')}}">Thư Viện</a></li>
                        <form action="{{route('search')}}">
                        <li> 
                            <input type="text" name="q" class="form-control" placeholder="Search">
                        </li>
                        <li class="search">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </li>
                    </form>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                         
                        
                        <li class="side-menu">
							<a href="{{route('user.cart')}}">
								<i class="fa fa-shopping-bag"></i>
                                <div id="totalcart">
                                    @if(session()->has('cart'))
                                    <?php $sanpham= session()->get('cart') ?>
                                    <span class="badge" id="total-show"><h3 style="color:red">{{$sanpham->totalQuantity}}</h3></span>
                                    @else
                                    <span class="badge" id="total-show">0</span>
                                    @endif
                                </div>
								<p>Giỏ Hàng</p>
                               
							</a>
                            
						</li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>
            <!-- Start Side Menu -->
            
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Tìm kiếm">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->