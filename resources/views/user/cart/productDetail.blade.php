@extends('user.layouts.master')
@section('content')
    <div class="card col-6 h-25 w-25 my-5 mx-auto">
        <!-- Product image-->
        <img class="card-img-top" src="{{ asset('storage/'.$product->image) }}" alt="..." style="height:250px;object-fit:cover" />
        <!-- Product details-->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">{{$product->price}}</h5>
                <input type="hidden" value="{{ Auth::user()->id }}" id="userId">
                <input type="hidden" value="{{ $product->id }}" id="productId">
                <!-- Product reviews-->
                <div class="d-flex justify-content-center small text-warning mb-2">
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                </div>
                <!-- Product price-->
                <span class="text-muted text-decoration-line-through">{{$product->price}}</span>
                {{$product->price}} Ks
                <div class="d-flex justify-content-center align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="number" class="form-control bg-danger border-0 text-center" value="1" id="cartCount">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-4 mt-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                        <a href="">
                            <button type="button" class="btn btn-outline-dark mt-auto" id="addCart">Add To Cart</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){
        // Add Cart
        $('#addCart').click(function(){
            $data = {
                   "cartCount" : $('#cartCount').val(),
                   "userId" : $('#userId').val(),
                   "productId" : $('#productId').val(),
                };
            $.ajax({
                type: "get",
                url: "/user/ajax/cart",
                data: $data,
                dataType: "json",
                success: function (response) {
                    if(response.status == 'success'){
                        window.location.href = "http://127.0.0.1:8000/user/home";
                    }
                }
            });
        });
    });
</script>
@endsection
