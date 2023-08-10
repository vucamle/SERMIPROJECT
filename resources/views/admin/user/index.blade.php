@extends('admin.user.sidebar')
@section('content')
<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><b>USER</b></h4>
                            <a href="{{route('user.create')}}" class="btn btn-success">Thêm mới</a>
                            <br>
                        </div>
                        <div class="panel-body">
                            <div class="bootstrap-table">
                                <table>            
                                    <tr class="">                
                                        <th>NAME</th>
                                        <th>PASSWORD</th>
                                        <th >EMAIL</th>
                                      
                                        <th >TRẠNG THÁI</th>
                                        <th >TÙY CHỌN</th>
                                    
                                    </tr>
                            
                                    @foreach($user ?? '' as  $users)
                                        <tr>
                                            <td style="text-align:center">{{$users->name}}</td>
                                            <td style="text-align:center"> {{$users->password}}</td>
                                                              
                                            <td style="text-align:center">{{$users->email}}</td>
  
                                        
                                            <td style="text-align:center">{{$users->trangthai}}</td>
                                            <td>
                                            <form action="{{route('user.destroy', $users->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                <a href="{{route('user.edit',$users->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
                                                <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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