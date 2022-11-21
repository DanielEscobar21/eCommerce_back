<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PaymentResource::collection(Payment::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orders = Order::where(["order_number"=>$request["order_number"]])->get();
        foreach ($orders as $order) {
            $order->status = "PAGADO.";
            $order->save();
        }
        return (new PaymentResource(Payment::create($request->all())))->additional(["message"=>"Pago registrado con Éxito."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return new PaymentResource($cart);
    }
}
