<div>
    @foreach ($teams as $team)
        <div>
            <a href="{{ route('show', $team -> id) }}">
                <h2>TEAM: {{$team -> name}}</h2>
            </a>
        </div>
    @endforeach
    
</div>