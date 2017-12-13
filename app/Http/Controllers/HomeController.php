<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function postImage(Request $request){
        if($request->hasFile('image')){
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $image = $request->file('image');
            $destinationPath = public_path('/images');
            $imageName  = time().'_'.$image->getClientOriginalName();
            $imageName = preg_replace('/\s+/', '', $imageName);
            if($image->move($destinationPath, $imageName)){
                return response()->json(['success'=>true, 'file'=>env('APP_URL').'/images/'.$imageName]);
            }

        }
        return response()->json(['success'=>false, 'file'=>env('APP_URL')]);
    }
}
