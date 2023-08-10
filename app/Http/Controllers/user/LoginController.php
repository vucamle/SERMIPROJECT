<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use session;
class LoginController extends Controller
{
    //
    public function getLogin()
    {
        if (Auth::check()) {
            return redirect('user/index');
        } else {
            return view('user/pages/login');
        }
    }
    public function postLogin(Request $request)
    {   
        $login = [
            'email' => $request->txtEmail,
            'password' => $request->txtPassword,
            'trangthai'    =>"1"
        ];
        
        if (Auth::attempt($login)) {
        $infoUser=['id'=>Auth::User()->id,'name'=>Auth::User()->name,'email'=>Auth::User()->email];
        $request->session()->put('infoUser',$infoUser);
        
            if(Auth::User()->level=="user")
            { 
                return redirect('user/index')->with('status', 'Đăng nhập thành công');
            }
        return redirect('panel/danhmuc')->with('status', 'Đăng nhập thành công');

       
       
        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }
    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->forget('infoUser');
        $request->session()->forget('cart');
        return view('user.pages.login');
    }
    public function Register()
    {
      
        return view('user.pages.register');
    }
    public function postRegister(Request $request)
    {
       
        $this->validate($request,
        [
            'name'=>'required',
            'email'=>'required|email|unique:user,email',
            'password'=>'required|min:6|max:20',
            'repassword'=>'required|same:password'
        ],
        [
            'name.required'=>'Vui lòng nhập tên',
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'email.unique'=>'Email đã tồn tại! Vui lòng nhập emal khác',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'repassword.required'=>'Vui lòng xác nhận mật khẩu',
            'repassword.same'=>'Xác nhận mật khẩu không giống nhau',
            'password.min'=>'Mật khẩu ít nhất 6 kí tự'
        ]);
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password = Hash::make($request->password);
        $user->level="user";
        $user->trangthai=1;
        if($user->save())
        return redirect()->route('getLogin')->with('status','Tạo tài khoản thành công!');  
    }
    
    public function myAccount()
    {
        if(session()->has('infoUser'))
        {
            $myaccount = session()->get('infoUser');
            
        }
        return view('user/pages/infouser',compact('myaccount'));
    }
    public function updateAccount(Request $request, $id)
    {
        $user = User::find($id);
        $data=$request->validate(
        [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6|max:20',
            'repassword'=>'required|same:password'
        ],
        [
            'name.required'=>'Vui lòng nhập tên',
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'repassword.required'=>'Vui lòng xác nhận mật khẩu',
            'repassword.same'=>'Xác nhận mật khẩu không giống nhau',
            'password.min'=>'Mật khẩu ít nhất 6 kí tự'
        ]);
        $data['password'] = Hash::make($data['password']);
        if($user->update($data))
        {
            return redirect()->route('myAccount')->with('status','Cập nhật tài khoản thành công!');  
        }
        else return redirect()->route('myAccount')->with('status','Thất bại');  
    }
}
