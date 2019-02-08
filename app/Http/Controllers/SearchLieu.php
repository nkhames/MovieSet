<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Annonce;

class SearchLieu extends Controller
{
    public function all(){

        $annonces = Annonce::all();
        $total = array();
        foreach ($annonces as $annonce){


            $fiche ='';
            /*if($dossier = opendir($annonce['path_to_dir'])){
                while(false !== ($fichier = readdir($dossier))){
                    $fiche = $fiche . '<img src="'.$annonce['path_to_dir'].'/'.$fichier .'" alt="Image not found" style="width:128px;height:128px;"/>';
                }
            }*/
            foreach(glob(public_path('svg/images/').$annonce['path_to_dir'].'/*') as $file) {
                $file = str_replace("\\", "/", $file);
                $file = str_replace("C:/laragon/www", "http://localhost/", $file);
                $fiche = $fiche . '<img src="'.$file.'" alt="Image not found" style="width:128px;height:128px;"/>';
                
            }

            $element = array( 
                "Description" =>$annonce['description'], 
                "Adresse" => $annonce['adresse'],  
                "Images" => $fiche,
                "Réserver" => '<button>Réserver</button>',
            );
            array_push($total, $element);
        }
        return view('Recherche', ['pokes' => $total]);
    }

    public function search(Request $request){
        $total = array();
        if($request->input('ascenceur')== 'on')
        $has_elevator = 1;
        else $has_elevator = 0;

        if($request->input('prix'))
        $prix = $request->input('prix');
        else $prix = 50000;

        if($request->input('m2'))
        $m2 = $request->input('m2');
        else $m2 = 0;

        if($request->input('mext'))
        $mext = $request->input('mext');
        else $mext = 0;

        if($request->input('nbpiece'))
        $nbpiece = $request->input('nbpiece');
        else $nbpiece = 0;

        if($request->input('text'))
        $description = $request->input('text');
        else $description = '';

        $annonces = DB::table('annonces')->select('*')->where([
            ['prix', '<', $prix],
            ['sup_int', '>', $m2],
            ['sup_ext', '>', $mext],
            ['nb_piece', '>', $nbpiece],
            ['has_elevator', '==', $has_elevator],
            ['description', 'like', '%'.$description.'%'],
        ])->get()->toArray();

        dd($annonces);

        foreach ($annonces as $annonce){
            $fiche ='';
            /*if($dossier = opendir($annonce['path_to_dir'])){
                while(false !== ($fichier = readdir($dossier))){
                    $fiche = $fiche . '<img src="'.$annonce['path_to_dir'].$fichier .'" alt="Image not found" style="width:128px;height:128px;"/>';
                }
            }*/

            foreach(glob(public_path('svg/images/').$annonce->path_to_dir.'/*') as $file) {
                $file = str_replace("\\", "/", $file);
                $file = str_replace("C:/laragon/www", "http://localhost/", $file);
                $fiche = $fiche . '<img src="'.$file.'" alt="Image not found" style="width:128px;height:128px;"/>';
                
            }
            $element = array( 
                "Description" =>$annonce->description, 
                "Adresse" => $annonce->adresse,  
                "Images" => $fiche,
                "Réserver" => '<button>Réserver</button>',
            );
            array_push($total, $element);
        }
        return view('Recherche', ['pokes' => $total]);
    }
}
