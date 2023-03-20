<?php 

namespace App\Http\Controllers\Admin;

use App\Models\Card;
use App\helpers\Attachment;
use Illuminate\Http\Request;
use App\Http\Requests\editCardRequest;
use App\Http\Requests\createCardRequest;

class CardController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $cards=Card::all();
    return view('cards.index',compact('cards'));
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('cards.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(createCardRequest $request)
  {
    $card=Card::create([
      'title'=>$request->title,
      'description'=>$request->description,
      
     ]);
  
        if ($request->hasFile('attachment'))
              {
                  Attachment::addAttachment($request->file('attachment'), $card, 'cards/image', ['save' => 'original','usage'=>'image']);
              }
    
              return redirect('/cards')->with(
                'success',
                'Card Added Successfully'
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
    $card=Card::find($id);
    return view('cards.edit',compact('card'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(editCardRequest $request,$id)
  {
    $card=Card::find($id);
    $card->update([
      'title'=>$request->title,
      'description'=>$request->description,
       ]);
       $old = $card->attachmentRelation[0];

       if ($request->hasFile('attachment'))
       {
         Attachment::updateAttachment($request->attachment ,$old, $card ,  'cards/image', ['save' => 'original','usage'=>'image']);
       }

       return redirect('/cards')->with(
         'success',
         'Card Edited Successfully'
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
    $card=Card::find($id);
    $attachment=$card->attachmentRelation[0];
    $card->delete();
    $attachment->delete();
    return redirect('/cards')->with(
      'success',
      'card deleted Successfully'
  );  



  }
  
}

?>