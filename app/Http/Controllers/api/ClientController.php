<?php

namespace App\Http\Controllers\api;

use App\helpers\helper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rate;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->helper = new helper();
    }

    public function Review(Request $request)
    {
        $validate = $request->validate([
            'rate' => 'required|in:1,2,3,4,5',
            'review' => 'required',
            'product_id' => 'required',
        ]);
        $product = Product::findOrFail($request->product_id);
        $review = new Rate();
        $review->rate = $validate['rate'];
        $review->review = $validate['review'];
        $review->product_id = $product->id;
        $review->client_id = auth()->user()->id;
        $review->name = auth()->user()->user_name;
        $review->email = auth()->user()->email;

        $review->save();

        return $this->helper->ResponseJson(1, __('apis.success'), [
            'review' => $review,

        ]);
    }
}
