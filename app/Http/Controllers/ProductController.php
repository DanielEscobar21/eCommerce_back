<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return (new ProductResource(Product::create($request->all())))->additional(["message"=>"Producto creado con éxito."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return (new ProductResource($product))->additional(["message"=>"Producto actualizado con éxito."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return (new ProductResource($product))->additional(["message"=>"Producto eliminado con éxito."]);
    }

    public function listOnStockProducts(){
        $products = Product::where("stock", ">", 0)->get();
        return ProductResource::collection($products);
    }

    public function productByCategory($category_id){
        $products = Product::where("category_id" , $category_id)->get();
        return ProductResource::collection($products);
    }

    public function searchProduct(Request $request){
        $products = Product::where("name",'ilike',$request->search."%")->get();
        return ProductResource::collection($products);
    }
}
