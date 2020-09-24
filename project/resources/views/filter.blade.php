<div>
    <h2>Hai filtrato per <br>
        @foreach ($types as $type)
            {{$type->name}} <br>
        @endforeach
    </h2>

    <a href="{{route('profile', $userId)}}">Annulla i filtri</a>

    @foreach ($query as $item)
    <div style="border: 1px solid black; width:500px">
        <h2>Pokemon Name: {{$item->name}}</h2>
        <h3>Team di appartenenza: {{$item-> team_name}}</h3>
        <img src="{{$item->picture}}" alt="">
    </div>
    @endforeach

</div>