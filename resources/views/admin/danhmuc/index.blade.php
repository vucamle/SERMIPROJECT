@extends('admin.danhmuc.sidebar')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><b>Danh Mục</b></h4>
                            <br>
                            <a href="{{route('danhmuc.create')}}" class="btn btn-success">Thêm mới</a>
                            <br><br>
                        </div>
                        <div class="panel-body">
                            <div class="bootstrap-table">
                                <table>            
                                    <tr class="">
                                        <th style="text-align:center" width="5%"> ID</th>
                                        <th style="text-align:center" width="20%">Tên Danh Mục</th>
                                        <th style="text-align:center" width="10%">Trạng Thái</th>
                                        <th style="text-align:center" width="8%">Tùy Chọn</th>
                                    </tr>
                                  @foreach($danhmucs ?? '' as $danhmuc)
								<tr >
                                    <th style="text-align:center">{{$danhmuc->id}}</th>
                                    <th style="text-align:center">{{$danhmuc->TenDanhMuc}}</th>
                                    <th style="text-align:center">{{$danhmuc->TrangThai}}</th>
                                    <td>
                                    <form action="{{route('danhmuc.destroy', $danhmuc->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                <a href="{{route('danhmuc.edit',$danhmuc->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
                                                @if($danhmuc->TrangThai==1)
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