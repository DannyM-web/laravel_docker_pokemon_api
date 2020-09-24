@extends('template')

@section('content')
    


<div>
    @if(session('message'))
    <div class="alert alert-info" role="alert">
        <h1 style="color:red">{{session('message')}}</h1>
      </div>
    @endif
    <h3>MY TEAMS</h3>
    <form action="{{route('filter')}}" method="GET">
        <label for="filter">FILTRA RICERCA</label>
        <div>
            <input type="hidden" name="user_id" value="{{$userId}}">
            @foreach ($types as $type)
            <label for="types[]">{{$type->name}}</label>
            <input type="checkbox" name="types[]" value="{{$type->id}}">
            @endforeach
        </div>
        <button type="submit">FILTRA</button>
    </form>
    <span><a href="{{route('create')}}">Create a new Team</a></span>
</div>
<div style="margin-top: 20px">
    @foreach ($list as $team)
    <div style="border:1px solid black; width:300px">
        <h4>NOME:
            <a href="{{ route('show',$team->id)}}">{{$team->name}}</a>
        </h4>
        <h3>Somma exp: {{$team->pokemons->sum('base_exp')}}</h3>
        @foreach ($team->pokemons as $pokemon)
        <div>
            <img src="{{$pokemon->picture}}" alt="">
        </div>
        @endforeach
    </div>
    @endforeach
</div>

@endsection