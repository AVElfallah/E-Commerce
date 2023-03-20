<?php

namespace App\Http\Controllers\api;

use App\helpers\helper;
use App\Http\Controllers\Controller;
use App\Mail\ForgetPassword;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->helper = new helper();
    }

    public function getPinCode()
    {
        $code = rand(1111, 9999);

        return $code;

    }
//register api
    public function register(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'user_name' => 'required',
            'email' => 'required|unique:clients,email',
            'governorate_id'=>'required|exists:govs,id',
            'password' => 'required|confirmed',
        ]);
        if ($validator->fails()) {
            return $this->helper->ResponseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $token = $client->createToken('APIToken')->accessToken;
        $client->save();
        return $this->helper->ResponseJson(1, 'success', [
            'token' => $token,
            'client' => $client,
        ]);
    }

//login api
    public function login(Request $request)
    {
        $validator = validator()->make($request->all(), [

            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {

            return $this->helper->ResponseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $client = Client::where('email', $request->email)->first();
        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                $token = $client->createToken('APIToken')->accessToken;

                return $this->helper->ResponseJson(1, 'success', [
                    'token' => $token,
                    'client' => $client,
                ]);
            } else {
                return $this->helper->ResponseJson(0, 'uncorrect data');
            }
        } else {
            return $this->helper->ResponseJson(0, 'uncorrect data');
        }
    }

//forget password
    public function forgetPassword(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'email' => 'required',
        ]);
        if ($validator->fails()) {

        return $this->helper->ResponseJson(0,$validator->errors()->first(),$validator->errors());
}
$client=Client::where('email',$request->email)->first();
if($client){
$code=$this->getPinCode();
Mail::to($client->email)->send(new ForgetPassword($client,$code));
return $this->helper->ResponseJson(1,'please check your email',['pin_code'=>$code]);
        }else{

            return $this->helper->ResponseJson(0, 'there is no user for this mail');
        }
    }

//set code to database
    public function setCode(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'email' => 'required',
            'pin_code' => 'required',
        ]);
        if ($validator->fails()) {

            return $this->helper->ResponseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $client = Client::where('email', $request->email)->first();
        if ($client) {
            $client->update(['pin_code' => $request->pin_code]);
            return $this->helper->ResponseJson(1, 'updated successfully');
        } else {

            return $this->helper->ResponseJson(0, 'there is no user for this email');

        }
    }

//reset
    public function reset(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'pin_code' => 'required',
            'password' => 'required|confirmed',
        ]);
        if ($validator->fails()) {

            return $this->helper->ResponseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $client = Client::where('pin_code', $request->pin_code)->where('pin_code', '!=', null)->first();
        if ($client) {

            $client->password = bcrypt($request->password);
            $client->save();
            return $this->helper->ResponseJson(1, 'password changed successfully');
        } else {
            return $this->helper->ResponseJson(0, 'this code invalid');

        }

    }

}
