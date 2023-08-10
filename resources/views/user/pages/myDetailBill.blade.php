
<div class="form-container">
                    <h1>Chi Tiết Hóa Đơn</h1>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr class="">
                                <th style="text-align:center" width="5%">ID_HoaDon</th>
                                <th style="text-align:center" width="20%">Tên Sản Phẩm</th>
                                <th style="text-align:center" width="10%">Số Lượng</th>
                                <th style="text-align:center" width="10%">Giá</th>
                                <th style="text-align:center" width="20%">Thành Tiền</th>
                                <th style="text-align:center" width="20%">Trạng Thái</th>
                            </tr>
                        </thead>
                        @foreach($chitiethoadons ?? '' as $chitiethoadon)
                        <tr>
                      
                                    <th style="text-align:center">{{$chitiethoadon->id_hoadon}}</th>
                                    <th style="text-align:center">{{$chitiethoadon->TenSP}}</th>
                                    <th style="text-align:center">{{$chitiethoadon->SoLuong}}</th>
                                    <th style="text-align:center">{{$chitiethoadon->Gia}}</th>
                                    <th style="text-align:center">{{$chitiethoadon->ThanhTien}}</th>
                                    @if($chitiethoadon->TrangThai=="Đã đặt hàng")
                                    <th style="text-align:center;color:green">{{$chitiethoadon->TrangThai}}</th>
                                    @else
                                    <th style="text-align:center;color:red">{{$chitiethoadon->TrangThai}}</th>
                                    @endif

                        </tr>
                        @endforeach


                    </table>
                    <div class="clearfix"></div>


                    <button type="submit" class="btn cancel" onclick="closeForm()">Đóng</button>
                </div>