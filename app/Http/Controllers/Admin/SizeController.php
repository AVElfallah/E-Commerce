<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        return view('sizes.index', compact('sizes'));
    }

    public function store(Request $request)
    {
        $size = Size::create($request->all());
        return redirect('/sizes')->with(
            'success',
            'size Added Successfully'
        );
    }

    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();
        return redirect()->back()->with('success', 'size deleted successfully');

    }
}