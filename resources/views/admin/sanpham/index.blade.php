@extends('admin.sanpham.sidebar')\
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><b>Sản Phẩm</b></h4>
                            <a href="{{route('sanpham.create')}}" class="btn btn-success">Thêm mới</a>
                            <br>
                        </div>
                        <div class="panel-body">
                            <div class="bootstrap-table">
                                <table>
                                    <tr class="">
                                        <th> ID</th>
                                        <th  width="50%"> Tên Sản Phẩm</th>
                                        
                                        <th>Danh Mục</th>
                                        <th>Giá</th>
                                        <th>Giá Mới</th>
                                        <th>Hình Ảnh 1</th>
                                        <th>Hình Ảnh 2</th>
                                        <th>Số Lượng</th>
                                        <th>Mô tả</th>
                                        <th> Trạng Thái</th>
                                        <th width="70%">Tùy chọn</th>
                                    </tr>

                                    @foreach($sanphams ?? '' as  $sanpham)
                                        <tr>
                                            <td style="text-align:center">{{$sanpham->id}}</td>
                                            <td style="text-align:center">{{$sanpham->TenSP}}</td>
                                            <td style="text-align:center"> {{$sanpham->DanhMuc}}</td>
                                            <td style="text-align:center">{{number_format($sanpham->Gia)}} VND</td>
                                            <td style="text-align:center">{{number_format($sanpham->GiaMoi)}} VND</td>
                                            <td><img class="img-thumbnail" src="{{asset('image/'.$sanpham->Image1)}}"></td>
                                            <td><img class="img-thumbnail" src="{{asset('image/'.$sanpham->Image2)}}"></td>
                                            <td style="text-align:center">{{$sanpham->SoLuong}}</td>
                                            <td style="text-align:center">{{$sanpham->Mota}}</td>
                                            <td style="text-align:center">{{$sanpham->TrangThai}}</td>
                                            <td>
                                            <form action="{{route('sanpham.destroy', $sanpham->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                <a href="{{route('sanpham.edit',$sanpham->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
                                                @if($sanpham->TrangThai==1)
                                                <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn hủy?')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                @else
                                                <button type="submit" onclick="return confirm('Bạn có muốn khôi phục?')" class="btn btn-success"><i class="fa fa-trash"></i></button>
                                                @endif
                                            </td>
                                            </form>
                                    @endforeach
                                </table>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
