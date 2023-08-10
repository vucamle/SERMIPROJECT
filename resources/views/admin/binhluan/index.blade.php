@extends('admin.binhluan.sidebar')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><b>Chi Tiết Bình Luận</b></h4>
                            <br>

                            <br><br>
                        </div>
                        <div class="panel-body">
                            <div class="bootstrap-table">
                                <table>
                                    <tr class="">
                                    <th style="text-align:center" width="5%">ID</th>
                                        <th style="text-align:center" width="5%">ID_USER</th>
                                        <th style="text-align:center" width="5%">Name</th>
                                        <th style="text-align:center" width="5%">ID_SANPHAM</th>
                                        <th style="text-align:center" width="20%">Nội Dung</th>
                                        <th style="text-align:center" width="10%">Trạng Thái</th>
                                        <th style="text-align:center" width="10%">Ngày Đăng</th>
                                        <th style="text-align:center" width="20%">Tùy Chọn</th>
                                    </tr>
                                  @foreach($binhluan ?? '' as $bl)
								<tr >
                                    <th style="text-align:center">{{$bl->id}}</th>
                                    <th style="text-align:center">{{$bl->id_user}}</th>
                                    <th style="text-align:center">{{$bl->name}}</th>
                                    <th style="text-align:center">{{$bl->id_sanpham}}</th>
                                    <th style="text-align:center">{{$bl->noidung}}</th>
                                    <th style="text-align:center">{{$bl->trangthai}}</th>
                                    <th style="text-align:center">{{$bl->ngaydang}}</th>

                                    <td>
                                    <form action="{{route('binhluan.destroy', $bl->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                <a href="{{route('binhluan.edit',$bl->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
                                                @if($bl->TrangThai==1)
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
