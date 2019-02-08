@extends('layouts.app')

@push("header")
<script src="{{ asset('js/fileinput.js') }}" defer></script>
<script src="{{ asset('js/locales/fr.js') }}" defer></script>
<link href="{{ asset('css/fileinput.css') }}" rel="stylesheet">
<link href="{{ asset('custom/custom.css') }}" rel="stylesheet">

<!-- At.js styles -->
<link href="{{ asset('css/jquery.atwho.css') }}" rel="stylesheet">

<!-- Caret.js -->
<script src="{{ asset('js/jquery.caret.js') }}" defer></script>

<!-- At.js -->
<script src="{{ asset('js/jquery.atwho.js') }}" defer></script>

<!-- test for inputfile-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.1/js/plugins/sortable.min.js"
    type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.1/js/plugins/purify.min.js"
    type="text/javascript"></script>

@endpush

@section('content')
<div class="row">

    <div class="col-2 " id="sidebanner"></div>

    <div class="container col-8 bg-light py-3 text-center">

        <form method="post" action="insert" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            <div class="pb-2 mt-4 mb-3 border-bottom ">
                <h2>Renseigner ces champs pour créer votre annonce !</h2>
            </div>
            <div class="form-row">
                <div class="form-group col-8">
                    <label for="annonce">Titre de l'annonce</label>
                    <input type="text" class="form-control" id="annonce" name="annonce_title" required>
                </div>

                <div class="form-group col-2">
                    <label for="prix">Prix</label>
                    <input type="text" class="form-control" id="prix" name="prix" placeholder="en €"
                        data-toggle="tooltip" data-placement="right"
                        title="Le prix correspond à la location pour une durée d'une demi-journée" required>
                </div>
            </div>


            <div class="form-group ">
                <label for="detail">Descriptif de votre bien</label>
                <textarea type="form-control" class="form-control" id="detail" name="text"
                    placeholder=" Essayer de mettre le plus possible en valeur votre bien en décrivant ces spécificités"
                    required></textarea>
            </div>


            <div class="form-row">
                <div class="form-group col-4">
                    <label for="city">Ville</label>
                    <input type="text" class="form-control" id="city" name="city" required>
                </div>

                <div class="form-group col">
                    <label for="adresse">Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" required>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col">
                    <label for="m2">Superficie</label>
                    <input type="text" class="form-control" id="m2" name="m2" placeholder=" en m²" required>
                </div>

                <div class="form-group col">
                    <label for="mext">Superficie exterieur <span class="badge badge-dark">Optionnel</span></label>
                    <input type="text" class="form-control" id="mext" name="mext" placeholder=" en m²">
                </div>


                <div class="form-group col">
                    <label for="nbpiece">Nombre de pièces mises à disposition</label>
                    <input type="text" class="form-control" id="nbpiece" name="nbpiece" required>
                </div>
            </div>

            <div class="card my-4">
                <div class="card-header text-center" id="headingOne">
                    <h4 class="mb-0">
                        <a type="button" class="btn btn-danger collapsed" data-toggle="collapse" href="#collapseOne" role="button" 
                            aria-expanded="false" aria-controls="collapseOne">

                            Détails accessibilité <span class="badge badge-dark"> Optionnel </span>
                        </a>
                    </h4>
                </div>

                <div id="collapseOne" class="collapse  my-2">
                    <div class="card-body">

                        <div class="input-group row my-3">
                            <div class="input-group-prepend ">
                                <span class="input-group-text" id="">Longueur et largeur de la porte d'entré</span>
                            </div>
                            <input type="text" class="form-control" name="long" placeholder=" longueur en cm">
                            <input type="text" class="form-control" name="larg" placeholder=" largeur en cm">
                        </div>

                        <div class="input-group row">
                            <div class="input-group-prepend ">
                                <span class="input-group-text" id="">Longueur et largeur de la cage d'escalier</span>
                            </div>
                            <input type="text" class="form-control" name="longE" placeholder=" longueur en cm">
                            <input type="text" class="form-control" name="largE" placeholder=" largeur en cm">
                        </div>

                        <div class="custom-control custom-checkbox row text-center mx-3">
                            <input type="checkbox" class="custom-control-input " id="customCheck1" name="ascenceur">
                            <label class="custom-control-label mx-3" for="customCheck1">.... Ascenceur
                                disponible</label>
                        </div>

                    </div>
                </div>
            </div>



            <div class="form-group">
                <input id="input-b3" name="photo[]" type="file" class="file" multiple data-show-upload="false"
                    data-show-caption="true" data-msg-placeholder="Ajouter des photos de votre bien ...">
            </div>
            <button type="submit" class="btn-lg btn-primary">Ajouter</button>

        </form>
    </div>
    <div class="col-2 bg-danger" id="sidebanner"></div>

    <script>
    // starter JavaScript for disabling form submissions if there are invalid fields
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

    $(function() {
        $('#detail').atwho({
            at: '#',
            // Adjust the delay in milliseconds to throttle requests to the server
            delay: 500,
            callbacks: {
                remoteFilter: function(query, callback) {
                    $.getJSON('/api/tags', {
                        tag: query
                    }, function(tags) {
                        callback(tags);
                    });
                }
            }
        })
    });
    </script>

    @endsection