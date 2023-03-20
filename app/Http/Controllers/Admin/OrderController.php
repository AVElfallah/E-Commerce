<?php 

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller 
{
/*  $order=Order::all();
    return view('orders.invoice');
    */
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $orders=Order::all();
    return view('orders.index',compact('orders'));
  }


  public function show($id){

    $order=Order::find($id);
    $items=$order->items;
    //OrderItem::where('order_id',$order->id)->get();
    return view('orders.invoice',compact('order','items'));


  }

  

  
  
}

?>