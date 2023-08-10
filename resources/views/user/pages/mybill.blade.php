@extends('user.layout')
@section('content')
<div class="col-sm-6 col-lg-12 mb-3">
    <div class="title-left">
        <h3>HÓA ĐƠN</h3>   
        <div class="form-popup" id="myForm">
            <div id="chitiethoadon">
                <div class="form-container">
                    <h1>Chi Tiết Hóa Đơn</h1>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr class="">
                                <th style="text-align:center" width="5%">ID_HoaDon</th>
                                <th style="text-align:center" width="20%">Tên Sản Phẩm</th>
                                <th style="text-align:center" width="10%">Số Lượng</th>
                                <th style="text-align:center" width="10%">Giá</th>
                                <th style="text-align:center" width="10%">Khuyến Mãi</th>
                                <th style="text-align:center" width="20%">Thành Tiền</th>
                                <th style="text-align:center" width="20%">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tr>

                            <th style="text-align:center"></th>
                            <th style="text-align:center"></th>
                            <th style="text-align:center"></th>
                            <th style="text-align:center"></th>
                            <th style="text-align:center"></th>
                            <th style="text-align:center"></th>
                            <th style="text-align:center"></th>
                            <th style="text-align:center"></th>
                        </tr>


                    </table>
                    <div class="clearfix"></div>


                    <button type="submit" class="btn cancel" onclick="closeForm()">Close</button>
                </div>
            </div>
        </div>
    </div>
    @if(count($hoadons)==0)
    <p>Bạn không có hóa đơn nào...</p>
    @else
    <table class="table">
        <thead class="thead-dark">
            <tr class="">



                <th style="text-align:center" width="20%">Họ Tên</th>
                <th style="text-align:center" width="10%">SĐT</th>
                <th style="text-align:center" width="20%">Địa Chỉ</th>
                <th style="text-align:center" width="15%">Thành Tiền</th>
                <th style="text-align:center" width="10%"> Trạng Thái</th>
                <th style="text-align:center" width="15%">Xem Chi Tiết</th>
                <th style="text-align:center" width="20%">Tùy chọn</th>
            </tr>
        </thead>
        @foreach($hoadons ?? '' as $hoadon)
        <tr>
            <th style="text-align:center">{{$hoadon->hoten}}</th>
            <th style="text-align:center">{{$hoadon->sdt}}</th>
            <th style="text-align:center">{{$hoadon->diachi}}</th>
            <th style="text-align:center">{{$hoadon->thanhtien}}</th>
            @if($hoadon->trangthai=="Đã đặt")
            <th style="text-align:center;color:green">{{$hoadon->trangthai}}</th>
            @else
            <th style="text-align:center;color:red">{{$hoadon->trangthai}}</th>
            @endif
            <td style="text-align:center"><button class="btn btn-lock" onClick="openForm({{$hoadon->id}})"><i class="fa fa-eye"></i></button></td>
            @if($hoadon->trangthai=="Đã đặt")
            <td style="text-align:center">
                
                <form action="{{route('cancelBill', $hoadon->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn hủy?')"
                        class="btn btn-danger"><i class="fa fa-trash"></i></button>
            </td>
            </form>
            @else
            <td style="text-align:center">
            </td>
            @endif
      
        </tr>
        @endforeach
    </table>
    <div class="clearfix"></div>
</div>
@endif
<div>
  
@stop