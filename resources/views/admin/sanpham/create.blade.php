@extends('admin.sanpham.sidebar')
@section('content')
<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-body">
                        <form action="{{route('sanpham.store')}}" method="POST"enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>Tên Sản Phẩm </label>
                                        <input type="text" class="form-control" name="TenSP" placeholder="Tên Sản Phẩm" >
                                    </div>
                                </div>
                                {{-- <div class="col-md-5 pr-1">
                                    <label>Loại sản phẩm:</label>
                                    <select name="MaLoai" class="form-control">
                                        <option value=''>---Vui lòng chọn loại sản phẩm---</option>>
                                        @foreach ($category as $key =>$cat)
                                        <option value="{{$cat->id}}">{{($key+1).'. '.$cat->tenloai}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>Danh Mục </label>
                                        <select name="DanhMuc" class="form-control">
                                            <option value=''>---Vui lòng chọn danh mục---</option>>
                                            @foreach ($danhmuc as $key =>$danhmucs)
                                            <option value="{{$danhmucs->id}}">{{($key+1).'. '.$danhmucs->TenDanhMuc}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá</label>
                                        <input type="text" name="Gia" class="form-control" placeholder="Giá">
                                    </div>
                                </div>
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá mới</label>
                                        <input type="text" name="GiaMoi" class="form-control" placeholder="Giá mới">
                                    </div>
                                </div>
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số lượng</label>
                                        <input type="text" name="SoLuong" class="form-control" placeholder="Số lượng">
                                    </div>
                                </div>
                                <div class="col-md-5 pr-1">
                                <div class="custom-file">
                                    <label for="exampleInputEmail1">Image1</label>
                                    <input type="file" name="Image1" id="ful" class="custom-file-input" />
                                </div>
                                <div class="form-group">
                                    <img id="imgPre" src="{{asset('image/noimage.jpg')}}" alt="no img" class="img-thumbnail" />
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
                                    <img id="imgPre1" src="{{asset('image/noimage.jpg')}}" alt="no img" class="img-thumbnail" />
                                    <p>
                                    <label class="custom-file-label" for="ful1"><i><u><b>Choose File</b></u></i></label>
                                    </p>
                                </div>
                                </div>
                               
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mô tả</label>
                                        <input type="text" name="MoTa" class="form-control" placeholder="Mô tả">
                                    </div>
                                </div>
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Trạng Thái</label>
                                        <input type="text" name="TrangThai" class="form-control" placeholder="Trạng thái">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                    <button type="submit" class="btn btn-info btn-fill pull-right">Thêm</button>
                    {{csrf_field()}}
                    </form>
                </div>
            </div>
        </div>
    </div>


    @stop
