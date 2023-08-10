<script src="{!! asset('user/js/jquery-3.2.1.min.js') !!}"></script>
    <script src="{!! asset('user/js/popper.min.js') !!}"></script>
    <script src="{!! asset('user/js/bootstrap.min.js') !!}"></script>
    <!-- ALL PLUGINS -->
    <script src="{!! asset('user/js/jquery.superslides.min.js') !!}"></script>
    <script src="{!! asset('user/js/bootstrap-select.js') !!}"></script>
    <script src="{!! asset('user/js/inewsticker.js') !!}"></script>
 
    <script src="{!! asset('user/js/images-loded.min.js') !!}"></script>
    <script src="{!! asset('user/js/isotope.min.js') !!}"></script>
    <script src="{!! asset('user/js/owl.carousel.min.js') !!}"></script>
    <script src="{!! asset('user/js/baguetteBox.min.js') !!}"></script>
    <script src="{!! asset('user/js/form-validator.min.js') !!}"></script>
    <script src="{!! asset('user/js/contact-form-script.js') !!}"></script>
    <script src="{!! asset('user/js/custom.js') !!}"></script>
    <!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    <script>
        function AddCart(id){
             $.ajax({
                 url:'../add-cart/'+id,
                 type:'GET',
             }).done(function(reponse){
               Render("#totalcart",reponse)
                alertify.success('Thêm vào giỏ hàng thành công!');
             });
        }
      
    </script>
    <script>
        $("#myComment").submit(function (e){
            e.preventDefault();
            $.ajax({
                url: "{{route('postComment')}}",
                type: 'POST',
                data:{
                    "_token":'{{csrf_token()}}',
                    "id_user":$("#inputid_user").val(),
                    "name":$("#inputname").val(),
                    "id_sanpham":$("#inputid_sanpham").val(),
                    "noidung":$("#inputcontent").val(),
                    "ngaydang":$("#inputngaydang").val(),
                    "trangthai":$("#inputtrangthai").val(),
                    },
             }).done(function(reponse){
                Render("#binhluan",reponse);
                alertify.success('Bình luận thành công!');
             });
        });
    </script>
    <script>
    
      function DeleteItemCart(id){
             $.ajax({
                 url:'../delete-item-cart/'+id,
                 type:'GET',
             }).done(function(reponse){
                Render("#listcart",reponse)
                alertify.error('Đã xóa sản phẩm...');
             });
        }
        function Render(id,reponse){
            $(id).empty();
            $(id).html(reponse);
        };
    </script>
    <script>
        function openForm(id) {
                document.getElementById("myForm").style.display = "block";
                $.ajax({
                    url:'../myDetailBill/'+id,
                    type:'GET',
                }).done(function(reponse){
                    Render("#chitiethoadon",reponse)
                });
            }

        function closeForm() {
        document.getElementById("myForm").style.display = "none";
        
        }
    </script>