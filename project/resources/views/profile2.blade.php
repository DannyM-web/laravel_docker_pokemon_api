@extends('template')

@section('content')

<div class="profile-container d-flex flex-column align-items-center">
    <div class="title d-flex justify-content-center col-sm-12">
        <div>
            <img src="https://fontmeme.com/permalink/200923/8e9fab0f575070933e5e02ba05c820d1.png" alt="font-pokemon"
                border="0">
        </div>
    </div>
    <div class="team-container row d-flex justify-content-between">
        @foreach ($list as $team)
        <div class="team-card row d-flex col-xs-12 col-md-6 col-lg-3">
            <div class="card-sx col">
                <div class="card-title d-flex justify-content-between">
                    <h4 class="">
                        <a href="{{ route('show',$team->id)}}">{{$team->name}}</a>
                    </h4>
                    <h5 class="exp-sum">Somma exp: {{$team->pokemons->sum('base_exp')}}</h5>
                </div>
                <div class="card-img d-flex justify-content-around flex-wrap">
                    @foreach ($team->pokemons as $pokemon)
                    <img style="height:100px; width:100px" src="{{$pokemon->picture}}" alt="">
                    @endforeach
                </div>
            </div>

        </div>
        @endforeach
    </div>
    @if (Auth::user()->id == $userId)
        
    <div class="create-button-container">
        <span>
            <a href="{{route('create')}}">
                <i class="create-plus fas fa-plus"></i>
            </a>
        </span>
    </div>
    @endif
</div>

@endsection