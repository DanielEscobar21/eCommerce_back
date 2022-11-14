<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return (new CartResource(Cart::create($request->all())))->additional(["message"=>"Producto agregado al carrito con éxito."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        return new CartResource($cart);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        $cart->update($request->all());
        return (new CartResource($cart))->additional(["message"=>"Carrito actualizado con éxito."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return (new CartResource($cart))->additional(["message"=>"Producto eliminado del carrito con éxito."]);
    }

    public function userCart($user_id){
        $cart = Cart::where("user_id" , $user_id)->get();
        return CartResource::collection($cart);
    }
}
