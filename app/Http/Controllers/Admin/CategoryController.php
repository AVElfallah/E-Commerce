<?php 

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\helpers\Attachment;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\createCategoryRequest;

class CategoryController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $categories=Category::all();
    return view('categories.index',compact('categories'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('categories.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(createCategoryRequest $request)
  {
    $category=Category::create([
      'name'=>$request->name,
      'description'=>$request->description,
      
    ]);
  
        if ($request->hasFile('attachment'))
              {
                  Attachment::addAttachment($request->file('attachment'), $category, 'categories/image', ['save' => 'original','usage'=>'image']);
              }
    
              return redirect('/categories')->with(
                'success',
                'Product Added Successfully'
            ); 
  }

  
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $category=Category::find($id);
    return view('categories.edit',compact('category'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(CategoryRequest $request, $id)
  {
    $category=Category::find($id);
    $category->update([
      'name'=>$request->name,
      'description'=>$request->description,
            ]);
            $old = $category->attachmentRelation[0];

            if ($request->hasFile('attachment'))
            {
              Attachment::updateAttachment($request->attachment ,$old, $category ,  'categories/image', ['save' => 'original','usage'=>'image']);
            }
  
            return redirect('/categories')->with(
              'success',
              'category Edited Successfully'
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
    $category=Category::find($id);
    $attachment=$category->attachmentRelation[0];
    $category->delete();
    $attachment->delete();
    return redirect('/categories')->with(
      'success',
      'category deleted Successfully'
  );  
  }
  
}

?>