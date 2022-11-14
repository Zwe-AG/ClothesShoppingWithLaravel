@extends('user.layouts.master')

@section('content')
<div class="d-flex justify-content-center mt-5">
    <div class="mx-2 d-flex">
            @foreach ($categories as $item)
            <a href="{{ route('product#filter',$item['id']) }}" class="nav-link text-dark text-uppercase fw-bolder">{{ $item['name'] }}</a></li>
            @endforeach
    </div>
    <div class="me-3">
        <select id="sorting" class="form-control">
            <option value="">Select</option>
            <option value="desc">Descending</option>
            <option value="asc">Ascending</option>
        </select>
    </div>
    <form class="d-flex">
        <a href="{{ route('cart#list') }}">
            <button class="btn btn-outline-dark" type="button">
                <i class="bi-cart-fill me-1"></i>
                Cart
                <span class="badge bg-dark text-white ms-1 rounded-pill">{{ count($carts) }}</span>
            </button>
        </a>
    </form>
</div>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="dataList">
                @foreach ($products as $product)
                <div class="col mb-5">
                <div class="card h-25">
                    <!-- Product image-->
                    <img class="card-img-top" src="{{ asset('storage/'.$product['image']) }}" alt="..." style="height:250px;object-fit:cover" />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">{{$product['price']}}</h5>
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Product price-->
                            <span class="text-muted text-decoration-line-through">{{$product['price']}}</span>
                            {{$product['price']}} Ks
                            <div class="card-footer p-4 mt-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a href="{{ route('product#detail',$product['id']) }}">
                                        <button type="button" class="btn btn-outline-dark mt-auto">Let's Buy</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                @endforeach
        </div>
    </div>
</section>
@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){
        $('#sorting').change(function(){
            $sortValue = $('#sorting').val();
            if ($sortValue == 'asc') {
                $.ajax({
                    type: "get",
                    url: "/user/ajax/orderby",
                    data: { 'status' : 'asc' },
                    dataType: "json",
                    success: function (res) {
                        $lists = "";
                        for ($i = 0; $i < res.length; $i++) {
                            $lists += `
                            <div class="col mb-5">
                <div class="card h-25">
                    <!-- Product image-->
                    <img class="card-img-top" src="{{ asset('storage/${res[$i].image}') }}" alt="..." style="height:250px;object-fit:cover" />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                            <input type="hidden" id="productId" value="{{ $product['id']}}">
                            <!-- Product name-->
                            <h5 class="fw-bolder">${res[$i].price}</h5>
                            <input type="hidden" value="1" id="cartCount">
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Product price-->
                            <span class="text-muted text-decoration-line-through">${res[$i].price}</span>
                            ${res[$i].price} Ks
                            <div class="card-footer p-4 mt-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <button type="button" class="btn btn-outline-dark mt-auto" id="addCart">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                             `;

                        }
                        $('#dataList').html($lists);
                    }
                });
            } else if($sortValue == 'desc'){
                $.ajax({
                    type: "get",
                    url: "/user/ajax/orderby",
                    data: { 'status' : "desc" },
                    dataType: "json",
                    success: function (res) {
                        $lists = "";
                        for ($i = 0; $i < res.length; $i++) {
                            $lists += `
                            <div class="col mb-5">
                <div class="card h-25">
                    <!-- Product image-->
                    <img class="card-img-top" src="{{ asset('storage/${res[$i].image}') }}" alt="..." style="height:250px;object-fit:cover" />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                            <input type="hidden" id="productId" value="{{ $product['id']}}">
                            <!-- Product name-->
                            <h5 class="fw-bolder">${res[$i].price}</h5>
                            <input type="hidden" value="1" id="cartCount">
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Product price-->
                            <span class="text-muted text-decoration-line-through">${res[$i].price}</span>
                            ${res[$i].price} Ks
                            <div class="card-footer p-4 mt-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <button type="button" class="btn btn-outline-dark mt-auto" id="addCart">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                    `;

                        }
                        $('#dataList').html($lists);
                    }
                });
            }
        });
    });
</script>
@endsection
