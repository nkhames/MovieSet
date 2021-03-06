<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Annonce;

class AnnonceCtrl extends Controller
{

    public function getform() {
        return view('propose_annonce');
     }

    public function insert(Request $request) {

        $annonce = new Annonce;

        $annonce->nom = $request->input('annonce_title');
        $city = $request->input('city');
        $annonce->adresse= $request->input('adresse').', '.$city;
        $annonce->sup_int = $request->input('m2');
        $annonce->sup_ext = $request->input('mext');
        $annonce->nb_piece= $request->input('nbpiece');

        if(!is_null($request->input('long')) && !is_null($request->input('larg')))
        $annonce->dim_porte = $request->input('long').'x'. $request->input('larg');
        else $annonce->dim_porte = null;

        if(!is_null($request->input('longE')) && !is_null($request->input('largE')))
        $annonce->dim_esc = $request->input('longE').'x'. $request->input('largE');
        else $annonce->dim_esc = null;

        if($request->input('ascenceur')== 'on')
        $annonce->has_elevator = 1;
        else $annonce->has_elevator = 0;
        $annonce->user_id = Auth::user()->id;
        $annonce->prix= $request->input('prix');
        $annonce->description= $request->input('text');
        if( $request->hasFile('photo') ) {

            $reponame = Auth::user()->id.'_'.$request->input('adresse');
            $reponame = str_replace(" ", "", $reponame);
            $annonce->path_to_dir = $reponame;
            $count= 0;
            $files = $request->file('photo');

            foreach($files as $file){
                $photo_name = 'photo'.$count;
                $file->move(public_path('svg/images/'.$reponame),'photo_'.$count.'.'.$file->extension()); // save photo in public
                $count ++;
            }
            
        }
        $annonce->save();
        //DB::insert('insert into annonces (nom, adresse, sup_int, sup_ext, nb_piece, has_elevator, dim_porte, dim_esc, user_id, description, path_to_dir, prix) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',[$title,$adresse,$superficie,$ext,$nbpiece,$ascenceur,$dimPorte,$dimEsc,$userid,$desc,$path,$prix]);
        echo "Annonce créer!.<br/>";
    }

    public function myAnnonce(){

        $annonces = DB::select('select * from annonces where user_id ='.Auth::user()->id);
        return view('my_annonces',['annonces'=>$annonces]);
    }

    public function destroy($id) {

        DB::delete('delete from annonces where id = ?',[$id]);
        return redirect()->route('mesannonces');
     }

     public function modify($id) {
        $annonce = DB::select('select * from annonces where id ='.$id);
        return view('modif_ annonce',['annonce'=>$annonce],['id'=>$id]);
     }

     public function update(Request $request)
     {
        $annonce = App/Annonce($request->id);

        $annonce->nom = $request->input('annonce_title');
        $city = $request->input('city');
        $annonce->adresse= $request->input('adresse').', '.$city;
        $annonce->sup_int = $request->input('m2');
        $annonce->sup_ext = $request->input('mext');
        $annonce->nb_piece= $request->input('nbpiece');

        if(!is_null($request->input('long')) && !is_null($request->input('larg')))
        $annonce->dim_porte = $request->input('long').'x'. $request->input('larg');
        else $annonce->dim_porte = null;

        if(!is_null($request->input('longE')) && !is_null($request->input('largE')))
        $annonce->dim_esc = $request->input('longE').'x'. $request->input('largE');
        else $annonce->dim_esc = null;

        if($request->input('ascenceur')== 'on')
        $annonce->has_elevator = 1;
        else $annonce->has_elevator = 0;
        $annonce->prix= $request->input('prix');
        $annonce->description= $request->input('text');
    
        $annonce->save();
        return view('my_annonces',['annonces'=>$annonces]);

     }


}
