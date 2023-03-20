<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rate;
use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\helpers\Attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\createProductRequest;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();

        return view('products.create', compact('categories', 'colors', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(createProductRequest $request)
   {
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);

        $product = $category->products()->create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'],
            'quantity' => $validatedData['quantity'],
            'price' => $validatedData['price'],
            'tax' => $validatedData['tax'],
            'title' => $validatedData['title'],
            'price_after_tax' => ($validatedData['price'] - $validatedData['tax']),
        ]);
        
                if ($request->hasFile('attachment')) {
            Attachment::addAttachment($request->file('attachment'), $product, 'products/image', ['save' => 'original', 'usage' => 'image']);
        }


        if ($request->colors) {
            foreach ($request->colors as $key => $color) {
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                ]);
            }

        }

        if ($request->sizes) {
            foreach ($request->sizes as $key => $size) {
                $product->productSizes()->create([
                    'product_id' => $product->id,
                    'size_id' => $size,
                ]);
            }

        }
        
        $product->save();


        return redirect('/products')->with(
            'success',
            'Product Added Successfully'
        );
    }


        public function show($id)
    {
        $product = Product::find($id);
        $reviews=Rate::where('product_id',$product->id)->limit(2)->get();       
         return view('products.show',compact('product','reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $product_color = $product->productColors()->pluck('color_id')->toArray();
        $colors = Color::whereNotIn('id', $product_color)->get();

        $product_size = $product->productSizes()->pluck('size_id')->toArray();
        $sizes = Size::whereNotIn('id', $product_size)->get();

        return view('products.edit', compact('categories', 'product', 'colors', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);

        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'tax' => $request->tax,
            'price_after_tax' => ($request->price - $request->tax),

        ]);

        $old = $product->attachmentRelation[0] ?? null;

        if ($request->hasFile('attachment')) {
            Attachment::updateAttachment($request->attachment, $old, $product, 'products/image', ['save' => 'original', 'usage' => 'image']);
        }

        if ($request->colors) {
            foreach ($request->colors as $key => $color) {
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                ]);
            }

        }

        if ($request->sizes) {
            foreach ($request->sizes as $key => $size) {
                $product->productSizes()->create([
                    'product_id' => $product->id,
                    'size_id' => $size,
                ]);
            }

        }

        return redirect('/products')->with(
            'success',
            'Product updated Successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products')->with(
            'success',
            'Product deleted Successfully'
        );
    }
    
     public function changeStatus(Request $request)
    {

         $product = Product::find($request->product_id);
        if ($product->is_featured == 0) {
            $product = DB::table('products')
                ->where('id', '=', $request->product_id)
                ->update(['is_featured' => 1]);
        } else {
            $product = DB::table('products')
                ->where('id', '=', $request->product_id)
                ->update(['is_featured' => 0]);

        }
        return response()->json(['success' => 'Status change successfully.']);

    }

}