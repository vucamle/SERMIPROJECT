@extends('admin.sanpham.sidebar')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-body">
                        <form action="{{route('sanpham.update',$sanpham->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>Tên Sản Phẩm </label>
                                        <input type="text" class="form-control" name="TenSP" value="{{$sanpham->TenSP}}" >
                                    </div>
                                </div>
                              
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>Danh Mục </label>
                                        <input type="text" class="form-control" name="DanhMuc" value="{{$sanpham->DanhMuc}}" >
                                    </div>
                                </div>
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá</label>
                                        <input type="text" name="Gia" class="form-control" value="{{$sanpham->Gia}}">
                                    </div>
                                </div>
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá mới</label>
                                        <input type="text" name="GiaMoi" class="form-control" value="{{$sanpham->GiaMoi}}">
                                    </div>
                                </div>
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số lượng</label>
                                        <input type="text" name="SoLuong" class="form-control" value="{{$sanpham->SoLuong}}">
                                    </div>
                                </div>
                                <div class="col-md-5 pr-1">
                                <div class="custom-file">
                                    <label for="exampleInputEmail1">Image1</label>
                                    <input type="file" name="Image1" id="ful" class="custom-file-input" />

                                </div>
                                <div class="form-group">
                                    <img id="imgPre" src="{{asset('image/'.$sanpham->Image1)}}" alt="no img" class="img-thumbnail" />
                                    <p>
                                    <label class="custom-file-label" for="ful"><i><u><b>Choose File</b></u></i></label>
                                    </p>
                                </div>
                                </div>
                                <div class="col-md-5 pr-1">
                                <div class="custom-file">
                                    <label for="exampleInputEmail1">Image2</label>
                                    <input type="file" name="Image2" id="ful1" class="custom-file-input" />

                                </div>
                                <div class="form-group">
                                    <img id="imgPre1" src="{{asset('image/'.$sanpham->Image2)}}" alt="no img" class="img-thumbnail" />
                                    <p>
                                    <label class="custom-file-label" for="ful1"><i><u><b>Choose File</b></u></i></label>
                                    </p>
                                </div>
                                </div>
                                
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mô tả</label>
                                        <input type="text" name="MoTa" class="form-control" value="{{$sanpham->MoTa}}">
                                    </div>
                                </div>
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Trạng Thái</label>
                                        <input type="text" name="TrangThai" class="form-control" value="{{$sanpham->TrangThai}}">
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
@stop
