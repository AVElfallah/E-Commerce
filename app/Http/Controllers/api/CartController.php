<?php

namespace App\Http\Controllers\api;

use App\Models\Gov;
use App\Models\Cart;
use App\helpers\helper;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\GovResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartDetailsResource;

class CartController extends Controller
{
    public function __construct()
    {
        $this->helper = new helper();
    }
    




    public function governerate()
{
    $gover = GovResource::collection(Gov::latest()->get());
    return $this->helper->ResponseJson(1, __('apis.success'), $gover);

}


public function createCart(Request $request){
    $validator=validator()->make($request->all(),[
        'product_id'=>'required',
        'product_color_id'=>'required',
        'product_size_id'=>'required',
        'quantity'=>'required',
        ]);
        if($validator->fails()){
      return $this->helper->ResponseJson(0,$validator->errors()->first(),$validator->errors());
        }
        
        $product=Product::findOrFail($request->product_id);
        $checkCartItem = Cart::where('client_id',auth()->user()->id)->where('product_id',$product->id)->first();
        if($checkCartItem){
            return $this->helper->ResponseJson(0, __('apis.cart_faild'));

        }
        if($product->quantity < $request->quantity){

            return $this->helper->ResponseJson(1, __('apis.quantity'));
          }
        $price=$product->price_after_tax;


        $cart=$request->user()->carts()->create([
            'product_id'=>$request->product_id,
            'product_color_id'=>$request->product_color_id,
            'product_size_id' =>$request->product_size_id,
            'quantity'=>$request->quantity,
            'client_id' => auth()->user()->id,
            'price'=>$price,
            'sub_total'=>($request->quantity*$price),
            'category_id'=>$product->category_id

           ]);
           return $this->helper->ResponseJson(1, __('apis.success'), $cart);

}

public function cartDetails(Request $request)
{
    $carts = Cart::where('client_id',auth()->user()->id)->get();

   $collectCartPrice = [];
   foreach($carts as $item)
   {
        $price = Cart::where('id',$item->id)->first();
        $collectCartPrice[] = $item->sub_total;
   }
    $totalprice = array_sum($collectCartPrice);
    if($carts != '[]')
    {
        return [
            'key' => 'succes',
            'sub_total'=>$totalprice,
            'total'=>$totalprice,
            'products' => CartDetailsResource::collection($carts)->map(function($row){
                return[
                    'data' =>$row

                ];
            })->values()->all()
        ];
    }




}









}
