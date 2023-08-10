@extends('user.layout')
@section('content')
<div class="col-sm-6 col-lg-6 mb-3">
                @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                    <p>{{$err}}</p>
                    @endforeach
                </div>
                @endif
                    <div class="title-left">
                        <h3>Tạo Tài Khoản Mới</h3>
                    </div>
                    
                    <form action="{{route('postRegister')}}" method="post">
                    {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" class="mb-0">Họ Tên</label>
                                <input type="text" class="form-control" name="name"  placeholder="Nhập họ tên"> </div>
                            <div class="form-group col-md-6"
                                <label for="email" class="mb-0">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Nhập Email"> </div>
                            <div class="form-group col-md-6">
                                <label for="password" class="mb-0">Password</label>
                                <input type="password" class="form-control" name="password" id="InputPassword1" placeholder="Password"> </div>
                            <div class="form-group col-md-6">
                                <label for="repassword" class="mb-0">Xác Nhận Password</label>
                                <input type="password" class="form-control" name="repassword" id="InputPassword1" placeholder="Xác nhận Password"> </div>
                            
                        </div>
                        <button type="submit" class="btn hvr-hover">Đăng Kí</button>
                    </form>
                </div>
@stop