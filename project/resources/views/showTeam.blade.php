<div>
<h2>Nome: {{$team -> name}} </h2>
<h3>Allenatore: {{$team -> user -> name}}</h3>
    @foreach ($team -> pokemons as $pokemon)
    <ul>
        <li>Pokemon: {{$pokemon -> name}}</li>
        <li>Base Exp: {{$pokemon -> base_exp }}</li>
        <li>Type: 
            @foreach ($pokemon -> types as $type)
                {{$type -> name}}
            @endforeach
        </li>
        <li>Abilities: 
            @foreach ($pokemon -> abilities as $ability)
                {{$ability -> name}}
            @endforeach
        </li>
        <li>
        {{-- <img style="width:100px; height:100px" src="{{$pokemon -> picture }}" alt="{{$pokemon -> name}}"> --}}
        </li>
    </ul>
    @endforeach
<form action="{{route('catch')}}">

    <input type="hidden" name="team_id" value="{{$team -> id}}">
    <button type="submit">Gotta Catch'em all</button>
</form>
    

</div>