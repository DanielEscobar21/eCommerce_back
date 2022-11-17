<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use App\Models\Cart;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'order_number'=> $this->order_number,
            'cart_id'=> $this->cart_id,
            'cart'=> new CartResource(Cart::where("id", $this->cart_id)->first()),
            'user_id'=> $this->user_id,
            'total_price' => $this->total_price,
            'status' => $this->status,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y')
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
        ];
    }
}
