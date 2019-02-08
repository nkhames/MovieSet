@extends('layouts.app')

@section('content')
<p> Vous avez pris {{ $nbphoto }} scenes en photos parmis les {{ $nbscene }} scenes diponible</p>
<div class="table-responsive">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Film Title</th>
      <th scope="col">Scene Title</th>
      <th scope="col">Year</th>
      <th scope="col">Picture</th>
    </tr>
  </thead>
  <tbody>
  @foreach($pokes as $poke)
    <tr>
      <th scope="row">{{ $poke["film"] }}</th>
      <td>{{ $poke["scene"] }}</td>
      <td>{{ $poke["year"] }}</td>
      <td>{!! html_entity_decode($poke["image"]) !!}</td>
      <td>{!! html_entity_decode($poke["insert"]) !!}</td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@endsection


@push('scripts')
<script>
/*Execute a function that will execute an image compare function for each element with the img-comp-overlay class:*/
initComparisons();
</script>
@endpush




