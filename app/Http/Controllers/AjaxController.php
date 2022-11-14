<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // order Desc Asc
    public function orderDescAsc(Request $request)
    {
        if ($request->status == "desc") {
            $data = Product::orderBy('created_at','desc')->get();
        }else if($request->status == "asc"){
            $data = Product::orderBy('created_at','asc')->get();
        }
        return $data;
    }

    // cart
    public function cart(Request $request)
    {
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response = [
            'status' => 'success',
        ];
        return response()->json($response,200);
    }

    // order
    public function orderProduct(Request $request)
    {
        $total = 0;
        $cityFee = 0;
        foreach ($request->all() as $item) {
            $cityFee = $item['cityFee'];
            $data = OrderList::create([
             'user_id' => $item['user_id'],
             'product_id' => $item['product_id'],
             'qty' => $item['qty'],
             'total' => $item['total'],
             'order_code' => $item['order_code'],
            ]);
            $total += $data->total;
         };
         Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total + $cityFee
        ]);
        $responses = [
            'status' => 'success',
        ];
        return response()->json($responses,200);
    }

    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'qty' => $request->cartCount,
        ];
    }
}
