<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LocInsertCtrl extends Controller
{
    public function insertform() {
        return view('add_loc');
     }

    public function insert(Request $request) {


        $title = $request->input('movie_title');
        
        $year = $request->input('year');
        $scene = $request->input('scene_title');
        $lat = $request->input('lat');
        $long = $request->input('long');
        if( $request->hasFile('photo') ) {

        $allowedfileExtension=['pdf','jpg','png'];
         $photo_name = $title.'_'.$scene;
         $extension = $request->file('photo')->extension();
         $request->file('photo')->move(public_path('svg/images/'),$photo_name.'.'.$extension ); // save photo in public
         $full_path= '/'.$photo_name.'.'.$extension; // save the path and the name of the photo in the db
        }

        

        DB::insert('insert into scenes (movie_title, scene_title, photo_path, year, longitude, latitude) values (?, ?, ?, ?, ?, ?)',[$title,$scene,$full_path,$year,$long,$lat]);
        echo "Record inserted successfully.<br/>";
        echo '<a href = "/">Click Here</a> to go back.';
     }

     public function check()
     {
        
     }

}
