<div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hình Ảnh</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Giá</th>
                                    <th>Số Lượng</th>
                                    <th>Tổng Cộng</th>
                                    <th>Hủy</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($newcart->products as $item)
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
									<img class="img-fluid" src="{!! asset('image/'.$item['productInfo']->Image1) !!}" alt="" />
								</a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
                                        {{$item['productInfo']->TenSP}}
								</a>
                                    </td>
                                    <td class="price-pr">
                                        <p>{{$item['productInfo']->GiaMoi}} VND</p>
                                    </td>
                                    <td class="quantity-box"><input type="number" size="4" value="{{$item['quantity']}}" min="0" step="1" class="c-input-text qty text"></td>
                                    <td class="total-pr">
                                        <p>{{$item['price']}} VND</p>
                                    </td>
                                    <td class="remove-pr">
                                        <a onClick="DeleteItemCart({{$item['productInfo']->id}})" href="javascript:">
									<i class="fas fa-times"></i>
								</a>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>