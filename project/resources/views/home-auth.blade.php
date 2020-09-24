<div class="index-container d-flex flex-column align-items-center">

    <div class="w-100 index-title">
        <img class="fluid-img" src="https://fontmeme.com/permalink/200923/1c950696cd1640c00e64b7b73994df61.png" alt="font-pokemon" border="0">
    </div>
    <div class="index-card-container d-flex justify-content-around flex-wrap">
        @foreach ($teams as $team)
        <div class="home-card d-flex flex-column col-sm-12 col-md-6 col-md-3">
            <div class="home-card-image">
                <img class="" src="{{url('/img/trainer.svg')}}" alt="pokeball">
            </div>
            <div class="home-card-info">
                <div>
                    <h3><strong>Allenatore:</strong> {{$team->user->name}}</h3>
                    <h4><strong>Team:</strong>
                        <a href="{{ route('show', $team -> id) }}">
                            {{$team->name}}
                        </a>
                    </h4>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>