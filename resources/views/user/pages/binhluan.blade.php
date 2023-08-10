@foreach($binhluans as $preview)
                        <div class="media mb-3">
                            <div class="mr-2">
                                <small class="text-muted">{{$preview->name}}</small>
                            </div>
                            <div class="media-body">
                                <p>{{$preview->noidung}}</p>
                                <small class="text-muted">{{$preview->ngaydang}}</small>
                            </div>
                        </div>
                        <hr>
            @endforeach