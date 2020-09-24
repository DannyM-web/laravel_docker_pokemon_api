@extends('template')
@section('content')
   

<div class="team-create-container d-flex flex-column align-items-center">
    <div class="team-create-title">
        <img class="img-fluid" src="https://fontmeme.com/permalink/200924/704da32d0849bb2bc02f09abbd0a89be.png" alt="font-pokemon" border="0">
    </div>
    <div class="team-create-form">

        <form class="container-sm d-flex flex-column justify-content-center align-items-center" action="{{route('store')}}" method="POST">
            @method('POST')
            @csrf
        
            <label for="name">Nome</label>
            <input type="text" id="" name="name" value="{{ old('name') }}" required>
            <br>
            <button class="create-submit" type="submit">Crea</button>
        </form>
    </div>
</div>

@endsection