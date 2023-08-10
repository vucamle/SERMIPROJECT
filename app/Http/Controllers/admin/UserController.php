<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;
class UserController extends Controller
{
    public function __construct()
    {
        $this->viewprefix='admin.user.';
        $this->viewnamespace='admin/user';
    }
    public function index()
    {
        $user = User::all();
        return view($this->viewprefix.'index', compact('user'));
    }

     public function create()
     {
         //
         return view($this->viewprefix.'create');
     }

     public function store(Request $request)
     {

         $user= new User;
        $this->validate($request, [
            'txtname' => 'required',
            'txtpassword' => 'required',
            'txtemail' => 'required',
            'txttrangthai' => 'required'

        ]);
        $user->name = $request->txtname;
        $user->password = Hash::make($request->txtpassword);
        $user->email = $request->txtemail;
       
        $user->trangthai = $request->txttrangthai;
        $user->level = "user";
         //if(Category::create($request->all()))
         if($user->save())
         {
             Session::flash('message', 'successfully!');
         }
         else
             Session::flash('message', 'Failure!');
         return redirect()->route('panel/index');
    }
    public function edit(User $user)
    {
        return view($this->viewprefix.'edit')->with('user', $user);
    }

    public function show(User $user)
    {
        //
    }
    public function update(Request $request, User $user)
    {
        $data=$request->validate([
            'txtname' => 'required',
            'txtpassword' => 'required',
           
            'txtemail' => 'required',
    
  
            'txttrangthai' => 'required'
        ]);
        $user->name = $request->txtname;
        $user->password = Hash::make($request->txtpassword);
        $user->email = $request->txtemail;
        $user->trangthai = $request->txttrangthai;
        if($user->update($data))
        {
            Session::flash('message', 'successfully!');
        }
        else
            Session::flash('message', 'Failure!');
        return redirect()->route('panel/index');
    }
    public function destroy($id)
    {


        $user = User::find($id);
        $user->delete();
        // $user= User::find($id);
        // if($user->trangthai==0){
        //     $user->trangthai=1;
        // }else
        // $user->trangthai=0;
        // if($user->update())
        //     Session::flash('message', 'successfully!');
        // else
        //     Session::flash('message', 'Failure!');
        // return redirect()->route('panel/index');
        return redirect()->route('panel/index');
    }


    
}
