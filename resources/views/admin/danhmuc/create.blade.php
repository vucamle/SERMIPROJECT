@extends('admin.danhmuc.sidebar')
@section('content')

<div class="content">
                <form action="{{route('danhmuc.store')}}" method="POST">
                        {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>Tên Danh Mục</label>
                                        <input type="text" class="form-control" name="TenDanhMuc" placeholder="Tên Danh Mục">
                                    </div>
                                </div>
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Trạng Thái</label>
                                        <input type="text" name="TrangThai" class="form-control" placeholder="Trạng Thái">
                                    </div>
                                </div>
                            </div>
                        <div class="clearfix"></div>
                                <button type="submit" class="btn btn-info btn-fill pull-right">Thêm</button>
                        
                </form>
</div>



@stop