@extends('template')

@section('content')
<div class="admin-panel-container d-flex flex-column align-items-center">

    <div class="admin-title">
        <img src="https://fontmeme.com/permalink/200929/ac82206841fe6f8ca706b06054d16d6a.png" alt="font-pokemon" border="0">
    </div>

    <div class="admin-table d-flex justify-content-center">

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendings as $pending)

                    <tr>
                        <th scope="row">{{$pending->id}}</th>
                        <td>{{$pending->name}}</td>
                        <td>{{$pending->email}}</td>
                        <td>{{$pending->status->name}}</td>
                        <td class="d-flex justify-content-between">
                            @if ($pending->status->name == 'pending')
                            <a href="{{route('acceptPending',$pending->user_id)}}"><i class="fas fa-check"></i></a>
                            <a href="{{route('rejectPending',$pending->user_id)}}" onclick="return confirm('Sei sicuro?')"><i class="far fa-times-circle"></i></a>
                            @endif
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            @endsection