<?php
namespace App\Classes;
use Illuminate\Http\Request;
class Helper{
    public function __construct()
    {
    }
    public static $URL = "http://192.168.1.173:8000/images/";
    public static function imageUpload(Request $request)
    {
        if($request->hasFile('image')){
            if($request->file('image')->isValid()){
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);
                $imageName = time().'.'.$request->image->extension();
                $request->image->move('images', $imageName);
                return $imageName;
            }
        }
        return "";
    } 

   

     public function __destruct()
    {
        
    }    
}
?>