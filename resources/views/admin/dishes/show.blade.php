@extends('layouts.app')

@section('content')
<div id="dish-show" class="container">
   Il piatto selezionato è: {{ $dish->name }}
   
</div>
@endsection