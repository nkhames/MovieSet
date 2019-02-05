<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Scenes;
use Auth;
use DB;

class Pokedex extends Controller
{
    public function pokedex(){

        $scenes = Scenes::all();
        $userid = Auth::user()->id;
        $ids = DB::table('photoscin')->select('photo_path', 'scene_id')->where('user_id', '=', $userid)->get()->toArray();
        $ids = json_decode(json_encode($ids), true);
        $photo = array();
        foreach($ids as $ide){
             $photo[$ide['scene_id']] = $ide['photo_path'];
        }
        $total = array();
        foreach ($scenes as $scene){
            $path = url('/').'/svg/images'.$scene['photo_path'];
            if(in_array($scene['id'], array_keys($photo))){
                $path2 = url('/').'/svg/images'. $photo[$scene['id']];
                $element = array( 
                    "film" =>$scene['movie_title'], 
                    "scene" => $scene['scene_title'],  
                    "year" => $scene['year'],
                    "image" => '<div class="img-comp-container"><div class="img-comp-img"><img src="'.$path.'" width="300" height="200"></div><div class="img-comp-img img-comp-overlay"><img src="'.$path2.'" width="300" height="200"></div></div>',
                );
            }
            else{
                $element = array( 
                    "film" =>$scene['movie_title'], 
                    "scene" => $scene['scene_title'],  
                    "year" => $scene['year'],
                    "image" => '<img src="'.$path.'" alt="Image not found" width="300" height="200" />',
                );
            }

            array_push($total, $element);
        }

        return view('Pokedex', ['pokes' => $total]);
    }
}

