<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gov;
use App\Models\Shipping;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Requests\ShippingRequest;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippings=Shipping::all();
        return view('shippings.index',compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $governorates=Gov::all();
    return view('shippings.create',compact('governorates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingRequest $request)
    {
        $shipping=Shipping::create([
            'governorate_id'=>$request->governorate_id,
            'cost'=>$request->cost,
           
           ]);

          
                    return redirect('/shippings')->with(
                      'success',
                      'Shipping Added Successfully'
                  );  } 
    

  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping=Shipping::find($id);
        $governorates=Gov::all();
    return view('shippings.edit',compact('shipping','governorates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingRequest $request, $id)
    {
        $shipping=Shipping::find($id);
    $shipping->update([
        'governorate_id'=>$request->governorate_id,
        'cost'=>$request->cost,
       ]);
       return redirect('/shippings')->with(
         'success',
         'Shipping Edited Successfully'
     ); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping=Shipping::find($id);
        $shipping->delete();
        return redirect('/shippings')->with(
            'success',
            'Shipping deleted Successfully'
        );
    }
}
