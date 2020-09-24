
@extends('template')

@section('content')


<div class="index-container d-flex flex-column align-items-center">

    @if(session('message'))
    <div class="alert alert-info" role="alert">
        <h1 style="color:red">{{session('message')}}</h1>
      </div>
    @endif
    <div class="w-100 index-title">
        <img class="img-fluid" src="https://fontmeme.com/permalink/200923/a2c1395d017ec7f70c48be1c59413e36.png"
            alt="font-pokemon" border="0">
    </div>
    <div class="index-card-container d-flex justify-content-between flex-wrap">
        @foreach ($team->pokemons as $pokemon)
        <div class="home-card d-flex flex-column col-sm-12 col-md-6 col-md-3">
            <div class="poke-card-top d-flex ">
                <div class="poke-card-img">
                    <img class="fluid-img" src="{{$pokemon->picture}}" alt="pokeimg" style="width: 130px; height:auto">
                </div>
                <div class="poke-card-abilities">
                    <img src="https://fontmeme.com/permalink/200923/494ee87f8807174e9fdb5565c44b293a.png"
                        alt="font-pokemon" border="0">
                    <ul class="abilities-list">
                        @foreach ($pokemon->abilities as $ability)
                            <li title="{{$ability->description}}" class="ability-item">{{$ability->name}} </li>

                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="home-card-info d-flex flex-column">
                <div class="poke-card-info-title">
                    <img src="https://fontmeme.com/permalink/200923/74a7c53eee25b5796c9e871a16b83ab7.png"
                        alt="font-pokemon" border="0">
                </div>
                <div class="poke-card-infos">
                    <ul class="poke-card-info-list">
                        <li class="col xs-6"><strong>Nome:</strong> {{$pokemon->name}}</li>
                        <li class="col xs-6"><strong>Exp:</strong> {{$pokemon->base_exp}}</li>
                        <li class="col xs-6"><strong>Tipo:</strong>
                            @foreach ($pokemon->types as $type)
                            {{$type->name}},
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if ($team -> user_id == $userId)
    <div class="option-team d-flex">
        <form action="{{route('catch')}}" class="">

            <input type="hidden" name="team_id" value="{{$team -> id}}">
            {{-- <button type="submit">Gotta Catch'em all</button> --}}
            <input title="Guadagna un nuovo pokemon" class="catchem" type="image" src="{{url('img/pokeball(1).png')}}" alt="">
        </form>

        <a title="Cancella il team" href="{{ route('delete', $team->id)}}"><img class="trash" src="{{url('img/trash-icon.jpg')}}" alt=""></a>

        <a title="Modifica il nome del team" href="{{ route('edit', $team->id)}}"><img class="edit" src="{{url('img/edit.png')}}" alt=""></a>
    </div>
    @endif
</div>

@endsection