<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    private $responce =[
        'message'=>'successful!',
        'code'=>200,
        'payload'=>[]
    ];

    public function register(Request $request){
        $validator = Validator::make($request->all() , [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validator->fails()){
            $this->responce['message'] = $validator->errors()->first();
            $this->responce['code'] = 419;
            return $this->responce;
        }
        $password = Hash::make($request->password);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        return $this->responce;
    }
    public function login(Request $request){
        $validator = Validator::make($request->all() , [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validator->fails()){
            $this->responce['message'] = $validator->errors()->first();
            $this->responce['code'] = 419;
            return $this->responce;
        }
        if(Auth::attempt($request->only('email' , 'password'))){
            $token =  Auth::user()->createToken('token')->plainTextToken;
            $this->responce['payload']['token'] = $token;
            return $this->responce;
        }
    }
    public function logout(Request $request){
        // $user->tokens()->where('id', $tokenId)->delete();
        // $request->user()->currentAccessToken()->delete();
        // return $request->user();
    }    
}
