@extends('user.layouts.master')
@section('content')
<!-- Cart Start -->
<div class="container-fluid" style="margin:150px 0px">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($cartLists as $cartList)
                    <tr>
                        {{-- <input type="hidden" value="{{ $cartList->pizza_price }}"> --}}
                        <td><img src="{{ asset('storage/'.$cartList->product_image) }}" style="width: 50px;"></td>
                        <td class="align-middle">
                            {{ $cartList->product_name }}
                            <input type="hidden" class="orderId" value="{{  $cartList->id }}">
                            <input type="hidden" class="userId" value="{{  $cartList->user_id }}">
                            <input type="hidden" class="productId" value="{{  $cartList->product_id }}">
                        </td>
                        <td class="align-middle" id="price">{{ $cartList->product_price }} kyats</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="number" class="form-control form-control-sm bg-danger border-0 text-center" value="{{ $cartList->qty }}" id="qty">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle" id="total">{{ $cartList->product_price*$cartList->qty }} kyats</td>                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 my-4">
                <div class="border-bottom pb-2 py-2 px-2">
                    <div class="d-flex justify-content-between">
                        <h5>Subtotal</h5>
                        <h5 id="subtotalprice">{{ $totalPrice }}</h5>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h5 class="font-weight-medium">Delivery</h5>
                        {{-- <h5 class="font-weight-medium">3000</h5> --}}
                        <select id="cityFee" required>
                            <option value="10000">Choose Place....</option>
                            <option value="3000">Insein</option>
                            <option value="2000">Hledan</option>
                            <option value="5000">Dagon</option>
                            <option value="6000">Sule</option>
                            <option value="5000">North Okkalapa</option>
                            <option value="4000">Yankin</option>
                        </select>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h4>Total</h4>
                        <h4 id="finalPrice">{{ $totalPrice+10000 }}</h4>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Proceed To Order</button>
                </div>
                <small class="text-danger">*** If you didn't choose place , give 10000 </small>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){
        $('.btn-minus').click(function(){
            $parentNode = $(this).parents('tr');
            $price = Number($parentNode.find('#price').html().replace('kyats',''));
            $qty = Number($parentNode.find('#qty').val());
            $total = $parentNode.find('#total');
            $operation = $price * $qty;
            $total.html($operation+"kyats");
            $selectValue = Number($("#cityFee option:selected").val());
            $totalSummary = 0;
            $('#dataTable tr').each(function (index, row) {
                $totalSummary += Number($(row).find('#total').text().replace('kyats',''));
            });
            $("#subtotalprice").html(`${$totalSummary}`);
            $("#finalPrice").html(`${$totalSummary+$selectValue}`)
        })
        $('.btn-plus').click(function(){
            $parentNode = $(this).parents('tr');
            $price = Number($parentNode.find('#price').html().replace('kyats',''));
            $qty = Number($parentNode.find('#qty').val());
            $total = $parentNode.find('#total');
            $operation = $price * $qty;
            $total.html($operation+"kyats");
            $selectValue = Number($("#cityFee option:selected").val());
            $totalSummary = 0;
            $('#dataTable tr').each(function (index, row) {
                $totalSummary += Number($(row).find('#total').text().replace('kyats',''));
            });
            $("#subtotalprice").html(`${$totalSummary}`);
            $("#finalPrice").html(`${$totalSummary+$selectValue}`)
        });
        $('#cityFee').on('change',function(){
            $selectValue = Number($(this).find(':selected').val());
            $totalSummary = 0;
            $('#dataTable tr').each(function (index, row) {
                $totalSummary += Number($(row).find('#total').text().replace('kyats',''));
            });
            $("#subtotalprice").html(`${$totalSummary}`);
            $("#finalPrice").html(`${$totalSummary+$selectValue}`)
        });
        $('#orderBtn').click(function(){
            $ordreList = [];
            $random = Math.floor(Math.random()*10000000001);
            $('#dataTable tbody tr').each(function(index,row){
                $ordreList.push({
                    'user_id' : $(row).find('.userId').val(),
                    'product_id' : $(row).find('.productId').val(),
                    'qty' : $(row).find('#qty').val(),
                    'total' : $(row).find('#total').text().replace('kyats',''),
                    'order_code' : 'POS'+ $random,
                    'cityFee' : Number($("#cityFee option:selected").val())
                });
            });
            $.ajax({
                type: "get",
                url: "/user/ajax/order",
                data: Object.assign({},$ordreList),
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

