<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BinhLuan;
use Session;
use App\Models\User;
use Illuminate\Http\Request;

class BinhLuanController extends Controller
{
    //
    public function __construct()
    {
        $this->viewprefix='admin.binhluan.';
        $this->viewnamespace='admin/binhluan';
    }
    public function index()
    {
        $binhluan = BinhLuan::all();
        return view($this->viewprefix.'index', compact('binhluan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
   **/

    public function create()
    {
        //
        return view($this->viewprefix.'create');
    }

    public function store(Request $request)
    {
        //



    }

    public function show(BinhLuan $binhluan)
    {
        //

    }

    public function edit(BinhLuan $binhluan)
    {
        return view($this->viewprefix.'edit')->with('binhluan', $binhluan);
    }

    public function update(Request $request, BinhLuan $binhluan)
    {
        $data=$request->validate([
            'noidung' => 'required',
            'trangthai' => 'required',
        ]);

        //if(Category::create($request->all()))
        if($binhluan->update($data))
        {
            Session::flash('message', 'successfully!');
        }
        else
            Session::flash('message', 'Failure!');
        return redirect()->route('binhluan.index');
    }


    public function destroy($id)
    {
        $binhluan=BinhLuan::find($id);
        if($binhluan->trangthai==0){
            $binhluan->trangthai=1;
        }else $binhluan->trangthai=0;
        if($binhluan->update())
            Session::flash('message', 'successfully!');
        else
            Session::flash('message', 'Failure!');
        return redirect()->route('binhluan.index');
    }
}
