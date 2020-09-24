

@extends('template')
@section('content')
   

<div class="team-create-container d-flex flex-column align-items-center">
    <div class="team-create-title container-sm">
        <img class="img-fluid" src="https://fontmeme.com/permalink/200924/f8fee39c7ac5a1a9b518df1c5c7c4ef0.png" alt="font-pokemon" border="0">
    </div>
    <form class="d-flex flex-column justify-content-center align-items-center container-sm" action="{{ route('update', $team->id)}}" method="POST">

        @method('POST')
        @csrf
        @if($errors->any())
        <h5>{{$errors->first()}}</h5>
        @endif
        <label for="name">Nuovo Nome</label>
        <input type="text" id="" name="name" value="{{ $team->name }}" required>
    
        <button class="create-submit" type="submit">MODIFICA</button>
    </form>
</div>

@endsection