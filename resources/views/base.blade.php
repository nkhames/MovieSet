@extends('layouts.app')

@section('content')
    {!! $map['js'] !!}
    {!! $map['html'] !!}
    <a href="{{ url('/test2') }}" style='margin: 0 auto; width: 50%;'><button  type="button" class="btn btn-secondary">Make trip</button></a>
@endsection

@push('scripts')
    <script>
        initComparisons();
    </script>
@endpush


