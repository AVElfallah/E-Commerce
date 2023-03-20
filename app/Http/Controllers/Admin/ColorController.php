<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\colorFormRequest;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('colors.index', compact('colors'));
    }

    public function create()
    {
        return view('colors.create');

    }

    public function store(colorFormRequest $request)
    {
        $validatedData = $request->validated();

        Color::create($validatedData);

        return redirect('/colors')->with('success', 'color added successfully');
    }

    public function changeStatus(Request $request)
    {

        $color = Color::find($request->color_id);
        if ($color->status == 0) {
            $color = DB::table('colors')
                ->where('id', '=', $request->color_id)
                ->update(['status' => 1]);
        } else {
            $color = DB::table('colors')
                ->where('id', '=', $request->color_id)
                ->update(['status' => 0]);

        }

        return response()->json(['success' => 'Status change successfully.']);

    }

    public function edit($id)
    {
        $color = Color::find($id);

        return view('colors.edit', compact('color'));
    }
    public function update(colorFormRequest $request ,$id)
    {
        $validatedData = $request->validated();

        $color = Color::find($id);
        $color->update($validatedData);
        $color->save();

        return redirect('/colors')->with('success','color updated successfully');


    }

    public function destroy($id)
    {
        $Color = Color::findOrFail($id);
        $Color->delete();
        return redirect()->back()->with('success', 'Color deleted successfully');

    }

}