@extends('admin.user.sidebar')
@section('content')

<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-body">
                        <form action="{{route('user.store')}}" method="POST"enctype="multipart/form-data">
                        <div class="row">
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>NAME</label>
                                        <input type="text" class="form-control" name="txtname" value="" >
                                    </div>
                                </div>
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>PASSWORD</label>
                                        <input type="password" class="form-control" name="txtpassword" value="">
                                    </div>
                                </div>
                            
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">EMAIL</label>
                                        <input type="text" name="txtemail" class="form-control" value="">
                                    </div>
                                </div>                    
                        
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Trạng Thái</label>
                                        <input type="text" name="txttrangthai" class="form-control" value="">
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
