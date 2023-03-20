<?php 

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Http\Requests\createSettingRequest;

class SettingController extends Controller 
{

  public function create()
  {
    $setting=Setting::first();
    return view('settings.create',compact('setting'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(createSettingRequest $request)
  {
    $setting=Setting::first();
    if($setting){
      $setting->update([
        'footer_desc'=>$request->footer_desc,
        'fb_link'=>$request->fb_link,
        'insta_link'=>$request->insta_link,
        'tw_link'=>$request->tw_link,
        'you_link'=>$request->you_link,
        'wha_link'=>$request->wha_link,
              ]);
            
         }else{
  $setting=Setting::create([
    'footer_desc'=>$request->footer_desc,
    'fb_link'=>$request->fb_link,
    'insta_link'=>$request->insta_link,
    'tw_link'=>$request->tw_link,
    'you_link'=>$request->you_link,
    'wha_link'=>$request->wha_link,
   ]);


}
return redirect('/home')->with(
  'success',
  'Success'
);  
        
  }

 

  
  
  
}

?>