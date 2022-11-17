<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CartResource extends JsonResource
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
            'user_id'=> $this->user_id,
            'product_id'=> $this->product_id,
            'quantity'=> $this->quantity,
            'amount'=> (Product::select('price')->where('id', $this->product_id)->first()->price)*$this->quantity,
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
