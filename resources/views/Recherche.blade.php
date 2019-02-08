@extends('layouts.app')

@section('content')
<div class="container">
<form method="post" action="research"  enctype="multipart/form-data" class="needs-validation" novalidate>
@csrf    
<div class="card my-4">
  <div class="card-header text-center" id="headingOne">
      <h4 class="mb-0">
          <a type="button" class="btn btn-danger collapsed" data-toggle="collapse" href="#collapseOne" role="button" 
              aria-expanded="false" aria-controls="collapseOne">

              Recherche 
          </a>
      </h4>
  </div>
<div id="collapseOne" class="collapse  my-2">
  <div class="card-body">

  <div class="form-group">
    <label for="prix">Prix maximum</label>
    <input type="text" class="form-control" id="prix" name="prix" required>
  </div>

  <div class="form-group">
    <label for="m2">Superficie minimum</label>
    <input type="text" class="form-control" id="m2" name="m2" placeholder=" en m²" required>
  </div>
  
  <div class="form-group">
    <label for="mext">Superficie exterieur minimum</label>
    <input type="text" class="form-control" id="mext" name="mext" placeholder=" en m²" >
  </div>

  <div class="form-group">
    <label for="nbpiece">Nombre de pièce minimum</label>
    <input type="text" class="form-control" id="nbpiece" name="nbpiece" required>
  </div>

<div class="custom-control custom-checkbox">
  <input type="checkbox" class="custom-control-input" id="customCheck1" name="ascenseur">
  <label class="custom-control-label" for="customCheck1">Ascenseur disponible</label>
</div>

<div class="form-group ">
    <label for="detail">Descriptif du bien rechercher</label>
    <textarea type="form-control" class="form-control" id="detail" name="text"
        placeholder=" Essayer d'utiliser des mots clés"
        required></textarea>
</div>

  <button type="submit" class="btn btn-primary">Rechercher</button>

</form>
</div>
</div>
</div>

<div class="table-responsive">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Description</th>
      <th scope="col">Adresse</th>
      <th scope="col">Images</th>
      <th scope="col">Réserver</th>
    </tr>
  </thead>
  <tbody>
  @foreach($pokes as $poke)
    <tr>
      <th scope="row">{{ $poke["Description"] }}</th>
      <td>{{ $poke["Adresse"] }}</td>
      <td>{!! html_entity_decode($poke["Images"]) !!}</td>
      <td>{!! html_entity_decode($poke["Réserver"]) !!}</td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@endsection

