@extends('template')

@section('content')

@if ($user->status->name == 'pending' )
<div class="queue-container d-flex text-center">
    <h3>La tua richiesta è in stato di approvazione. I nostri admin stanno esaminando la sua richiesta.</h3>
</div>
@elseif($user->status->name == 'rejected' )
<div class="queue-container d-flex text-center">
    <h3>La tua richiesta di registrazione è stata rifiutata dai nostri admin. Mi dispiace</h3>
</div>
@endif



@endsection