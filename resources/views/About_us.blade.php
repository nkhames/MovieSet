@extends('layouts.app')

@section('content')

<div class="container">
  <h2>About us</h2>
  <div class="row" style="margin-bottom:15;">
    MovieSet a pour objectif d’optimiser et simplifier le processus de repérage de lieux de tournage pour les équipes de production à moindre budget/expérience. 
    Notre solution se présente sous la forme d’un site web et d’une application mobile qui met en relation les équipes de tournage d’une part, 
    et les propriétaires de biens immobiliers divers et variés d’autre part.
  </div>
  
  <div class="row">
    <div class="col">
      <b>Briac Boulet</b> <br>
      <em>Chef de projet</em><br>
      <img src="{{asset('svg/images/BB.png')}}" alt="Image not found" class="center" style="width:128px;height:128px;"/><br>
      <img src="{{asset('svg/images/mail.png')}}" alt="Image not found" style="width:20px;height:20px;"/> briacboulet@gmail.com<br>
      <img src="{{asset('svg/images/phone.png')}}" alt="Image not found" style="width:20px;height:20px;"/> 06 79 47 88 87
    </div>
    <div class="col">
      <b>Jean-Baptiste Crespo</b> <br>
      <em>Pôle développement</em> <br>
      <img src="{{asset('svg/images/JBC.jpg')}}" alt="Image not found" class="center" style="width:128px;height:128px;"/><br>
      <img src="{{asset('svg/images/mail.png')}}" alt="Image not found" style="width:20px;height:20px;"/> j-b.crespo@edu.ece.fr<br>
      <img src="{{asset('svg/images/phone.png')}}" alt="Image not found" style="width:20px;height:20px;"/> 06 52 41 36 87
    </div>
    <div class="col">
      <b>Arthur Decroix </b> <br>
      <em>Pôle création </em> <br>
      <img src="{{asset('svg/images/ADC.jpg')}}" alt="Image not found" class="center" style="width:128px;height:128px;"/><br>
      <img src="{{asset('svg/images/mail.png')}}" alt="Image not found" class="center" style="width:20px;height:20px;"/> arthur@edu.ece.fr<br>
      <img src="{{asset('svg/images/phone.png')}}" alt="Image not found" style="width:20px;height:20px;"/> 06 72 94 91 95
    </div>
    <div class="col">
      <b>Naïm Khames</b> <br>
      <em>Pôle développement</em><br>
      <img src="{{asset('svg/images/NK.jpg')}}" alt="Image not found" class="center" style="width:128px;height:128px;"/><br>
      <img src="{{asset('svg/images/mail.png')}}" alt="Image not found" style="width:20px;height:20px;"/> naim@edu.ece.fr<br>
      <img src="{{asset('svg/images/phone.png')}}" alt="Image not found" style="width:20px;height:20px;"/> 06 32 49 84 92 
    </div>
    <div class="col">
      <b>Isabelle Seck </b> <br>
      <em>Pôle valorisation concours</em><br>
      <img src="{{asset('svg/images/IS.jpg')}}" alt="Image not found" class="center" style="width:128px;height:128px;"/><br>
      <img src="{{asset('svg/images/mail.png')}}" alt="Image not found" style="width:20px;height:20px;"/> isabelle@edu.ece.fr<br>
      <img src="{{asset('svg/images/phone.png')}}" alt="Image not found" style="width:20px;height:20px;"/> 06 85 85 91 01
    </div>
  </div>
</div>  
@endsection