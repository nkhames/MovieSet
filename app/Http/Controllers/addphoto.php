<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class addphoto extends Controller
{
    //
    public function add(Request $request){

        $userid = Auth::user()->id;
        $sceneid = $request->input('sceneId');
        $photo = $request->file('input-b1');
        $extension = $request->file('input-b1')->extension();
        $photo_name = 'photo'.$userid.$sceneid.'.'.$extension ;
        $photo->move(public_path('svg/images/'),$photo_name);


        DB::table('photoscin')->insert(
            ['photo_path' => $photo_name, 'user_id' => $userid, 'scene_id' => $sceneid]
        );

        return redirect()->back();

    }
}
