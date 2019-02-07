<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scenes;
use FarhanWazir\GoogleMaps\GMaps;
use Auth;
use DB;
use GeoIP;
//use Request;

class MapController extends Controller
{

    protected $gmap;

    public function __construct(GMaps $gmap){
        $this->gmap = $gmap;
    }

    public function drawMarkers($chemin)
    {
        $scenes = Scenes::all();

        //$config['center']= '48.8534, 2.3488';
        
        $config['center']='auto';
        $config['zoom']= '10';
        $config['map_height']='500px';
        

        if($chemin){
            $config['directions'] = true;
            $config['directionsWaypointsOptimize'] = true;
            $config['directionsStart'] = "auto";                    
            $config['directionsEnd'] = "auto";
            //$config['directionsDivID'] = "";
            //$ip = Request::ip();
            $location = GeoIP::getLocation(); 
            $config['directionsWaypointArray'] = array();
            foreach ($scenes as $scene){
                if(($scene['latitude']-1 < $location['lat']) && ($location['lat'] < $scene['latitude']+1) && ($scene['longitude']-1 < $location['lon']) && ($location['lon'] < $scene['longitude']+1)){
                    $a = sprintf("%.3f", $scene['latitude']);
                    $b = sprintf("%.3f", $scene['longitude']);  
                    $point =    $a . ',' . $b;
                    array_push($config['directionsWaypointArray'], $point);
                //}
                }
            }   
        }
        $config['scrollwheel']=true;
        //GMaps::initialize($config);
        $this->gmap->initialize($config);
        $config['jsfile'] = asset('js/slider.js');
        //$config['loadAsynchronously'] = true;
        $path =  'https://googlemaps.github.io/js-marker-clusterer/images';
        $this->gmap->cluster = true;
        $this->gmap->clusterStyles =array( 
            array( 
               "url" => $path.'/m1.png' ,
               "height" => 53, 
               "width" => 53,
           ), 
           array( 
               "url" =>$path. '/m2.png' ,
               "height" => 56,  
               "width" => 56, 
           ), 
           array( 
              "url" => $path.'/m3.png' , 
              "height" => 66, 
              "width" => 66,
           ),
           array( 
               "url" => $path.'/m4.png',
               "height" => 78,  
               "width" => 78,
           ), 
           array( 
               "url" =>$path. '/m5.png',
               "height" => 90,  
               "width" => 90,
           )
       ); 
         
       $userid = Auth::user()->id;
       $ids = DB::table('photoscin')->select('photo_path', 'scene_id')->where('user_id', '=', $userid)->get()->toArray();
       $ids = json_decode(json_encode($ids), true);
       $photo = array();
       foreach($ids as $ide){
            $photo[$ide['scene_id']] = $ide['photo_path'];
       }
        foreach ($scenes as $scene){
            //$a = (string)$scene->latitude;
            //$b = (string)$scene->longitude;
            $a = sprintf("%.3f", $scene['latitude']);
            $b = sprintf("%.3f", $scene['longitude']);  
            $marker['position'] =    $a . ',' . $b; 
            
            //GMaps::add_marker($marker);
            if(in_array($scene['id'], array_keys($photo))){
                $marker['icon'] = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png';
                $path2 = url('/').'/svg/images'. $photo[$scene['id']];
                $marker['infowindow_content']= $this->drawFiche2($scene['movie_title'], $scene['scene_title'],url('/').'/svg/images'. $scene['photo_path'], $path2 ,$scene['year']);
            }
            else{
                $marker['icon'] ='http://maps.google.com/mapfiles/ms/icons/red-dot.png';
                $marker['infowindow_content']= $this->drawFiche($scene['movie_title'], $scene['scene_title'],url('/').'/svg/images'. $scene['photo_path'], $scene['year']);
            }
            $this->gmap->add_marker($marker);
        }
        //$map = GMaps::create_map();
        $map = $this->gmap->create_map();
        //return view('base')->with('map', $map); 
        return view('base', ['map' => $map]);
    }

    public function drawFiche($film, $scene, $path, $year)
    {
        $fiche ='<h4>'.$scene.'</h4><br> <b> Film : </b>'. $film. '<br> <b> Année : </b> ' . $year.' <br> <img src="'.$path.'" alt="Image not found" style="width:128px;height:128px;"/>';

        return $fiche;
    }

    public function drawFiche2($film, $scene, $path, $path2, $year)
    {
        $fiche ='<h4>'.$scene.'</h4><br> <b> Film : </b>'. $film. '<br> <b> Année : </b> ' . $year.' <br> <div class="img-comp-container"><div class="img-comp-img"><img src="'.$path.'" width="300" height="200"></div><div class="img-comp-img img-comp-overlay"><img src="'.$path2.'" width="300" height="200"></div></div>';

        return $fiche;
    }
}

//'<h4>'.$scene['scene_title'].'</h4><br> <b> Film : </b>'. $scene['movie_title']. '<br> <b> Année : </b> ' . $scene['year'].' <br> <img src="'.$scene['photo_path'].'" alt="Image not found" style="width:128px;height:128px;"/>';

