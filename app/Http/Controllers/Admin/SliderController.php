<?php

namespace App\Http\Controllers\Admin;

use App\helpers\Attachment;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('sliders.create');

    }
    public function store(SliderRequest $request)
    {
        $slider = Slider::create($request->validated());

        if ($request->hasFile('attachment')) {
            Attachment::addAttachment($request->file('attachment'), $slider, 'Sliders/image', ['save' => 'original', 'usage' => 'SliderImage']);
        }

        return redirect('/sliders')->with(
            'success',
            'Slider Added Successfully'
        );
    }

    public function changeStatus(Request $request)
    {
        $slider = Slider::find($request->id);
        $slider->status = $request->status;
        $slider->save();
        return response()->json(['success' => 'Status change successfully.']);

    }
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->attachmentRelation[0]->delete();
        $slider->delete();
        return redirect()->back()->with('success', 'Color deleted successfully');

    }

}