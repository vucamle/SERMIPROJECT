@extends('admin.layout')
@section('sidebar')
<div class="sidebar" data-image="{!! asset('admin/img/sidebar-5.jpg') !!}">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="http://www.creative-tim.com" class="simple-text">
                    @if(session()->has('infoUser'))
                        <?php $info= session()->get('infoUser')?> {{$info['name']}}
                    @else
                        YOU DON'T LOGIN
                    @endif
                    </a>
                </div>
                <ul class="nav">
                   
                    <li >
                        <a class="nav-link" href="{{route('sanpham.index')}}">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Sản Phẩm</p>
                        </a>
                    </li>
                   
                    <li>
                        <a class="nav-link" href="{{route('panel/index')}}">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>User</p>
                        </a>
                    </li>
                  
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('danhmuc.index')}}">
                            <i class="nc-icon nc-bullet-list-67"></i>
                            <p>Danh Mục</p>
                        </a>
                    </li>
                   
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#pablo">Danh Mục </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="dropdown">
                                    <i class="nc-icon nc-palette"></i>
                                    <span class="d-lg-none">Danh Mục</span>
                                </a>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <i class="nc-icon nc-planet"></i>
                                    <span class="notification">5</span>
                                    <span class="d-lg-none">Thông Báo</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Notification 1</a>
                                    <a class="dropdown-item" href="#">Notification 2</a>
                                    <a class="dropdown-item" href="#">Notification 3</a>
                                    <a class="dropdown-item" href="#">Notification 4</a>
                                    <a class="dropdown-item" href="#">Another notification</a>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nc-icon nc-zoom-split"></i>
                                    <span class="d-lg-block">&nbsp;Search</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                                <a class="nav-link" href="{{route('getLogout')}}">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            @stop
