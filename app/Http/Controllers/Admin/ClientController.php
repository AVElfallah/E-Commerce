<?php 

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller 
{
   public function index(){
    $clients=Client::all();
    return view('clients.index',compact('clients'));
   

}

public function changeStatus(Request $request)

  {
    $client=Client::find($request->id);
      $client->status = $request->status;
      $client->save();
      return response()->json(['success'=>'Status change successfully.']);

  }

public function delete($id){

  $client=Client::find($id);
  $client->delete();
  return redirect('/view-clients')->with(
    'success',
    'client deleted Successfully'
);  
}

}

?>