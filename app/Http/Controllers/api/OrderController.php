<?php

namespace App\Http\Controllers\api;

use App\Models\Gov;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\helpers\helper;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->helper = new helper();
    }

    public function checkout(Request $request){
        $validator=validator()->make($request->all(),[
            'first_name'=>'required',
            'last_name'=>'required',
            'company_name'=>'required',
            'governorate_id'=>'required|exists:govs,id',
            'address'=>'required',
            'city'=>'required',
            'country_state'=>'required',
            'post_code'=>'required',
            'phone'=>'required',
            'notes'=>'required',
            ]);
            if($validator->fails()){
          return $this->helper->ResponseJson(0,$validator->errors()->first(),$validator->errors());
            }
            $gov=Gov::findOrFail($request->governorate_id);
            $order = Order::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company_name'=>$request->company_name,
                'governorate_id'=>$gov->id,
                'address'=>$request->address,
                'city'=>$request->city,
                'country_state'=>$request->country_state,
                'post_code'=>$request->post_code,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'notes'=>$request->notes,
                'client_id'=>auth()->user()->id
            ]);
            $order->save();
            $cart=Cart::where('client_id',auth()->user()->id)->get();
    
            foreach($cart as $item)
            {
                OrderItem::create([
                    'product_id'=>$item->product_id,
                    'product_color_id'=>$item->product_color_id,
                    'product_size_id'=>$item->product_size_id,
                    'quantity'=>$item->quantity,
                    'price'=>$item->price,
                    'sub_total'=>$item->sub_total,
                    'order_id'=>$order->id,
                    'category_id'=>$item->category_id
    
                ]);
                $product = Product::where('id',$item->product_id)->first();
                $product->decrement('quantity',$item->quantity);
                $price = Cart::where('id',$item->id)->first();
                 $collectCartPrice[] = $item->sub_total;
            }
            $sub_total = array_sum($collectCartPrice);
            $shipping = Shipping::where('governorate_id',$request->governorate_id)->first()->value('cost');
    
            $total = $sub_total + $shipping;
    
            $order->update([
                'sub_total' => $sub_total,
                'total' => $total
            ]);
    
    
            $cartItems = Cart::where('client_id',auth()->user()->id)->get();
    
            Cart::destroy($cartItems);
    
    
    
               return $this->helper->ResponseJson(1, __('apis.success'), $order);
    
    
    }






}
