@extends('admin.danhmuc.sidebar')
@section('content')

<div class="content">
                    <form action="{{route('danhmuc.update',$danhmuc->id)}}" method="POST" enctype="multipart/form-data">
                             @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên Danh Mục</label>
                                        <input type="text" name="TenDanhMuc" class="form-control" placeholder="Tên Danh Mục" value="{{$danhmuc->TenDanhMuc}}">
                                    </div>
                                </div>
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Trạng Thái</label>
                                        <input type="text" name="TrangThai" class="form-control" placeholder="Trạng Thái" value="{{$danhmuc->TrangThai}}">
                                    </div>
                                </div>
                            </div>
                        <div class="clearfix"></div>
                                <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
                </form>
</div>
@stop