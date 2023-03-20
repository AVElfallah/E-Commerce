<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use Illuminate\Http\Request;
 use PDF;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $order=Order::findOrFail($id);
        $items= $order->items;

        $data = [
            'order' => $order,
            'items'=>$items,
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('myPDF', $data)->setOptions(['defaultFont' => 'sans-serif']);;
    
        return $pdf->download('orderDetails.pdf');
    }
}