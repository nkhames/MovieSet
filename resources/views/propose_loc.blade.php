@extends('layouts.app')

@section('content')
<div class="container">
<form method="post" action="create"  enctype="multipart/form-data" class="needs-validation" novalidate>
@csrf
<div class="form-group">
    <label for="annonce">Titre de l'annonce'</label>
    <input type="text" class="form-control" id="annonce" placeholder="Entrer un titre pour la scène" name="annonce_title" required>
    
    </div>
        <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
        <label class="custom-control-label" for="customRadioInline1">Toggle this custom radio</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
      <label class="custom-control-label" for="customRadioInline2">Or toggle this other custom radio</label>
    </div>

  <div class="form-group">
    <label for="FilmTitle">Titre film</label>
    <input type="text" class="form-control" id="FilmTitle" placeholder="titre du film" name="movie_title" required>
  </div>

  <div class="form-group">
    <label for="FilmDate">Date film</label>
    <input type="text" class="form-control" id="FilmDate" placeholder="Date de sortie du film" name="year" required>
  </div>
  <div class="row">
    <div class="col">
      <label for="Lat">Latitude</label>
      <input type="text" class="form-control" id="Lat" placeholder="latitude wip" name="lat" required>
    </div>
    <div class="col">
      <label for="Long">Longitude</label>
      <input type="text" class="form-control" id="Long"  placeholder="longitude wip" name="long" required>
    </div>
  </div>
 
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="customFile" name="photo" required>
    <label class="custom-file-label" for="customFile">Choisir une image de la scène</label>
  </div>
  
  <button type="submit" class="btn btn-primary">Ajouter</button>

</form>
</div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
@endsection