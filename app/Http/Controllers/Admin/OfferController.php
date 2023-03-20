<?php 

namespace App\Http\Controllers\Admin;

use App\Models\Offer;
use App\helpers\Attachment;
use Illuminate\Http\Request;
use App\Http\Requests\editOfferRequest;
use App\Http\Requests\createOfferRequest;

class OfferController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $offers=Offer::all();
    return view('offers.index',compact('offers'));

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('offers.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(createOfferRequest $request)
  {
    $offer=Offer::create([
      'title'=>$request->title,
      'description' => $request->description,
      ]);
  
        if ($request->hasFile('attachment'))
              {
                  Attachment::addAttachment($request->file('attachment'), $offer, 'offers/image', ['save' => 'original','usage'=>'image']);
              }
    
              return redirect('/offers')->with(
                'success',
                'Offer Added Successfully'
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
    $offer=Offer::find($id);
    return view('offers.edit',compact('offer'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(editOfferRequest $request,$id)
  {
    $offer=Offer::find($id);
    $offer->update([
      'title'=>$request->title,
       ]);
       $old = $offer->attachmentRelation[0];

       if ($request->hasFile('attachment'))
       {
         Attachment::updateAttachment($request->attachment ,$old, $offer ,  'offers/image', ['save' => 'original','usage'=>'image']);
       }

       return redirect('/offers')->with(
         'success',
         'offer Edited Successfully'
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
    $offer=Offer::find($id);
    $attachment=$offer->attachmentRelation[0];
    $offer->delete();
    $attachment->delete();
    return redirect('/offers')->with(
      'success',
      'offer deleted Successfully'
  );  
  }
  public function changeStatus(Request $request)

  {
    $offer=Offer::find($request->id);
      $offer->status = $request->status;
      $offer->save();
      return response()->json(['success'=>'Status change successfully.']);

  }





  
}

?>