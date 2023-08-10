@extends('user.layout')
@section('content')
            <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="title-left">
                        <h3>ĐĂNG NHẬP</h3>
                    </div>
                                @if (session('status'))
                    <ul>
                        <li class="text-success"> {{ session('status') }}</li>
                    </ul>
                @endif
                    <form action="{{route('getLogin')}}" method="post">
                    {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputEmail" class="mb-0">Email</label>
                                <input type="email" name="txtEmail" class="form-control" id="InputEmail" placeholder="Nhập Email"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword" class="mb-0">Password</label>
                                <input type="password" name="txtPassword" class="form-control" id="InputPassword" placeholder="Password"> </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Đăng nhập</button>
                    </form>
                </div>
                <div class="col-lg-4">
                <p>Bạn chưa có tài khoản? <a href="{{route('register')}}" style="color:blue">Đăng kí</a> ngay!</p>
                </div>
            </div>
<div>
@stop