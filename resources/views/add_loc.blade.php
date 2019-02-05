@extends('layouts.app')

@section('content')
<style>          
  #map { 
    height: 300px;    
    width: 600px;            
  }          
</style>   
<div class="container">
<form method="post" action="create"  enctype="multipart/form-data" class="needs-validation" novalidate>
@csrf

  <div class="form-group">
    <label for="SceneTitle">Titre de la scène</label>
    <input type="text" class="form-control" id="SceneTitle" placeholder="Entrer un titre pour la scène" name="scene_title" required>
    
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
<div style="padding:10px">
    <div id="map"></div>
</div>

<script type="text/javascript">
var map;
var markers = [];
function initMap() {                            
    var latitude = 48.8534; // YOUR LATITUDE VALUE
    var longitude = 2.3488; // YOUR LONGITUDE VALUE
    
    var myLatLng = {lat: latitude, lng: longitude};
    
    map = new google.maps.Map(document.getElementById('map'), {
      center: myLatLng,
      zoom: 14,
      disableDoubleClickZoom: true, // disable the default map zoom on double click
    });
    
    // Update lat/long value of div when anywhere in the map is clicked    
    google.maps.event.addListener(map,'click',function(event) {                
        document.getElementById('Lat').value = event.latLng.lat();
        document.getElementById('Long').value =  event.latLng.lng();
    });
    
    // Update lat/long value of div when you move the mouse over the map
    google.maps.event.addListener(map,'mousemove',function(event) {
        document.getElementById('Lat').innerHTML = event.latLng.lat();
        document.getElementById('Long').innerHTML = event.latLng.lng();
    });
            
    /*var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      //title: 'Hello World'
      
      // setting latitude & longitude as title of the marker
      // title is shown when you hover over the marker
      title: latitude + ', ' + longitude 
    });   
    
    // Update lat/long value of div when the marker is clicked
    marker.addListener('click', function(event) {              
      document.getElementById('latclicked').innerHTML = event.latLng.lat();
      document.getElementById('longclicked').innerHTML =  event.latLng.lng();
    });*/
    
    // Create new marker on double click event on the map
    google.maps.event.addListener(map,'dblclick',function(event) {
        hideMarkers(map, markers);
        console.log("Remove All Markers");
        var marker = new google.maps.Marker({
          position: event.latLng, 
          map: map, 
          title: event.latLng.lat()+', '+event.latLng.lng()
        });

        markers.push(marker);
        // Update lat/long value of div when the marker is clicked
        marker.addListener('click', function() {
          document.getElementById('Lat').innerHTML = event.latLng.lat();
          document.getElementById('Long').innerHTML =  event.latLng.lng();
        }); 
    });

    function hideMarkers(map, markers) {
    /* Remove All Markers */
    while(markers.length){
        markers.pop().setMap(null);
    }

    console.log("Remove All Markers");
    }
    
    // Create new marker on single click event on the map
    /*google.maps.event.addListener(map,'click',function(event) {
        var marker = new google.maps.Marker({
          position: event.latLng, 
          map: map, 
          title: event.latLng.lat()+', '+event.latLng.lng()
        });                
    });*/
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfiM2u64_uXCJix9FUFClwXDC_huQkmO0&callback=initMap"
async defer></script>
@endsection