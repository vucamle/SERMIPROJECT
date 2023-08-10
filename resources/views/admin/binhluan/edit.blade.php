@extends('admin.binhluan.sidebar')
@section('content')

<div class="content">
                    <form action="{{route('binhluan.update',$binhluan->id)}}" method="POST" enctype="multipart/form-data">
                             @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nội Dung</label>
                                        <input type="text" name="noidung" class="form-control" placeholder="Nội Dung Bình Luận" value="{{$binhluan->noidung}}">
                                    </div>
                                </div>
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Trạng Thá<i></i></label>
                                        <input type="text" name="trangthai" class="form-control" placeholder="Số Lượng" value="{{$binhluan->trangthai}}">
                                    </div>
                                </div>


                            </div>
                        <div class="clearfix"></div>
                                <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
                </form>
</div>
@stop
