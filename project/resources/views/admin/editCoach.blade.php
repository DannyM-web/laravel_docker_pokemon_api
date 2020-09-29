@extends('template')

@section('content')
    
<div class="d-flex justify-content-center align-items-center">


<form action="{{route('updateCoach',$user->id)}}" method="post">
    @csrf
    @method('POST')
    
    <label for="name">Nome</label>
    <input type="text" name="name" id="" value="{{$user->name}}">
    
    <button type="submit">MODIFICA</button>
    
    
</form>

</div>

@endsection
