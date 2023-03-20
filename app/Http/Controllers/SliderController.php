<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\helpers\Attachment;
use Illuminate\Http\Request;
use App\Http\Requests\editSliderRequest;
use App\Http\Requests\CreateSliderRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders=Slider::all();
        return view('sliders.index', compact('sliders'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSliderRequest $request)
    {
        $slider=Slider::create([
            'title'=>$request->title,
            'description'=>$request->description,
            
           ]);
        
              if ($request->hasFile('attachment'))
                    {
                        Attachment::addAttachment($request->file('attachment'), $slider, 'sliders/image', ['save' => 'original','usage'=>'image']);
                    }
          
                    return redirect('/sliders')->with(
                      'success',
                      'Slider Added Successfully'
                  );
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider=Slider::find($id);
        return view('sliders.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editSliderRequest $request, $id)
    {
        
        $slider=Slider::find($id);
    $slider->update([
      'title'=>$request->title,
      'description'=>$request->description,
       ]);
       $old = $slider->attachmentRelation[0];

       if ($request->hasFile('attachment'))
       {
         Attachment::updateAttachment($request->attachment ,$old, $slider ,  'sliders/image', ['save' => 'original','usage'=>'image']);
       }

       return redirect('/sliders')->with(
         'success',
         'slider Edited Successfully'
     ); 
    }

    public function changeStatus(Request $request)

  {
    $slider=Slider::find($request->id);
      $slider->status = $request->status;
      $slider->save();
      return response()->json(['success'=>'Status change successfully.']);

  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider=Slider::find($id);
        $attachment=$slider->attachmentRelation[0];
        $slider->delete();
        $attachment->delete();
        return redirect('/sliders')->with(
          'success',
          'slider deleted Successfully'
      );  
    }
}
