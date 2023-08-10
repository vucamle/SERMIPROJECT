<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ThongBao;
use App\Classes\Helper;
use Illuminate\Support\Facades\Hash;
use Auth;
class UserController extends Controller
{
    public function postLogin(){
      
        $login = [
            'email' => request('email'),
            'password' => request('password'),
        ];
        if (Auth::attempt($login)) {
            $user = Auth::user();
            if($user->HinhThuc != "Facebook"){
            $user->avatar = Helper::$URL.$user->avatar;
            }
            $success = $user->createToken('DoAnCaNhanLaravel')->accessToken;
            return response()->json([
            'status' => true,
            'message' => 'Sign in successfully!',
            'data' => $user,
            'token' => $success
             ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Email or password invalid!',
            'data' => [],
        ]);
    }
    public function postLogout() {
        $user = Auth::user();
        $user->token()->revoke();
        return response()->json([
                'status' => 'true',
                'message' => 'Log out successfully!'
                 ]);
    }
    public function postSignUp(){
        $f = User::whereemail(request('email'))->get();
        if(count($f)==0){
            $user= new User;
            $user->name = request('name');
            $user->password = Hash::make(request('password'));
            $user->email = request('email');
            $user->DiaChi = request('DiaChi');
            $user->avatar =  request('avatar');
            $user->SDT = request('SDT');
            $user->HinhThuc = request('HinhThuc');
            $user->trangthai = 1;
            $user->level = "user";
            if($user->save())
            {
                return response()->json([
                    'status' => 'true',
                    'message' => ""
                ]);
            }return response()->json([
                'status' => 'false',
                'message' => ""
            ]);
        } return response()->json([
            'status' => 'true',
            'message' => ""
        ]);
        
    }
    public function getInfoUser($id){
        $user = User::find($id);
        
        return response()->json([
            'status' => true,
            'message' => "Successfully",
            'data' => $user
        ]);
    }
    public function checkEmail(Request $request){
        $user = User::whereemail($request->email);
        if(!empty($user)){
            return response()->json([
                'status' => 'true',
                'message' => "Successfully",
                'data' => $user
            ]);
        }
        return response()->json([
            'status' => 'false',
            'message' => "Successfully",
            'data' => $user
        ]);
    }
    public function changePassword(Request $request){
        $user = User::whereemail($request->email)->get();
        $user[0]->password = Hash::make($request->password);
        $user[0]->update();
        return response()->json([
            'status' => 'true',
            'message' => "Successfully",
            'data' => null
        ]);
    }
    public function changeInfo($id, Request $request){
        $user = User::find($id);
        if(!empty($request->name)){
            $user->name = $request->name;
        }else if(!empty($request->phone)){
            $user->SDT = $request->phone;
        }else {
            $user->DiaChi = $request->address;
        }
        if($user->update()){
            if($user->HinhThuc!="Facebook"){
                $user->avatar = Helper::$URL.$user->avatar;
            }
            
            return response()->json([
                'status' => 'true',
                'message' => "Successfully",
                'data' => $user
            ]);
        } return response()->json([
            'status' => 'false',
            'message' => "Failure",
            'data' => null
        ]);
    }
    public function changeAvatar($id, Request $request){
        $user = User::find($id);
        $user->avatar = Helper::imageUpload($request);
        $user->update();
        if($user->HinhThuc!="Facebook"){
            $user->avatar = Helper::$URL.$user->avatar;
        }
        return response()->json([
            'status' => 'true',
            'message' => "Successfully",
            'data' => $user
        ]);
    }
    public function updateNotification($id){
        $thongbao = ThongBao::find($id);
        $thongbao->trangthai = 1;
        $thongbao->update();
        return response()->json([
            'status' => 'true',
            'message' => "Successfully",
            'data' => null
        ]);
    }
    public function getTotalNotification($id){
        $thongbao = ThongBao::whereiduser($id)->wheretrangthai(0)->get();
        return response()->json([
            'status' => 'true',
            'message' => "Successfully",
            'data' => $thongbao
        ]);
    }
    public function deleteNotification($id){
        $thongbao = ThongBao::find($id);
        $thongbao->delete();
        return response()->json([
            'status' => 'true',
            'message' => "Successfully",
            'data' => null
        ]);
    }
    public function getNotification($id){
        $thongbao = ThongBao::whereiduser($id)->get();
        return response()->json([
            'status' => 'true',
            'message' => "Successfully",
            'data' => $thongbao
        ]);
    }
}
