<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cart = Cart::where('id', $request["cart_id"])->first();
        $cart->active = false;
        $cart->save();
        $product = Product::where('id', $cart->product_id)->first();
        $data = [
            'order_number' => $request["order_number"],
            'cart_id' => $request["cart_id"],
            'user_id' => $request["user_id"],
            'total_price' => floatval($cart->quantity) * floatval($product->price),
            'status' => 'PENDIENTE DE PAGO'
        ];

        return (new OrderResource(Order::create($data)))->additional(["message"=>"Orden creada con éxito."]);
    }

    public function getAllFullOrderByOrderNumber(){
        $orders = Order::select('order_number')->distinct()->get();
        $response = [];
        foreach ($orders as $key => $order) {
            $totals = Order::select('total_price')->where('order_number', $order->order_number)->get();
            $sum = 0;
            foreach ($totals as $total) {
                $sum += $total->total_price;
            }
            $array=array(
                "user_id" => Order::select('user_id')->where('order_number', $order->order_number)->distinct()->first()->user_id,
                "total" => number_format($sum,2),
                "status" => Order::select("status")->where('order_number', $order->order_number)->distinct()->first()->status,
                $order->order_number=> Order::where('order_number', $order->order_number)->get()
            );
            array_push($response,$array);
        }
        return response($response, $status = 200);
    }

    public function getFullOrderByOrderNumber($order_number){
        $response = [];
        $totals = Order::select('total_price')->where('order_number', $order_number)->get();
        $sum = 0;
        foreach ($totals as $total) {
            $sum += $total->total_price;
        }
        $array=array(
            "user_id" => Order::select('user_id')->where('order_number', $order_number)->distinct()->first()->user_id,
            "total" => number_format($sum,2),
            "status" => Order::select("status")->where('order_number', $order_number)->distinct()->first()->status,
            $order_number=> Order::where('order_number', $order_number)->get()
        );
        array_push($response,$array);
        return response($response, $status = 200);
    }
}
