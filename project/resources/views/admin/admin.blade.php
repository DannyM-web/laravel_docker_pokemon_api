@extends('template')

@section('content')


<div class="admin-panel-container d-flex flex-column align-items-center">

    <div class="admin-title">
        <img src="https://fontmeme.com/permalink/200927/3a4e77fdf255cef9f829e6adba608e64.png" alt="font-pokemon"
            border="0">
    </div>

    <div class="admin-table d-flex justify-content-center">

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)

                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td><a href="{{route('profile',$user->id)}}">{{$user->name}}</a></td>
                        @foreach ($user->roles as $role)
                        <td>{{$role->name}}</td}>
                            @endforeach
                            @if (!$user->roles->contains('name','admin'))
                        <td>
                            <a href="{{route('editCoach',$user->id)}}"><i class="far fa-edit"></i></a>
                            <a href="{{route('deleteCoach',$user->id)}}" onclick="return confirm('Sei sicuro?')"><i
                                    class="fas fa-trash"></i></a>
                        </td>

                        @endif
                    </tr>

                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="admin-form-create align-self-end">
            <h5>Creation Panel</h5>
            @if($errors->any())
            <h5>{{$errors->first()}}</h5>
            @endif
            <form action="{{route('createCoach')}}" method="post">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="username" class="text-info">Username:</label><br>
                    <input type="text" name="name" id="" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password" class="text-info">Password:</label><br>
                    <input type="password" name="password" id="" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password" class="text-info">Conferma Password:</label><br>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                        required>
                </div>
                <div class="form-group">
                    <label for="role">Tipo di utente:</label>
                    <select name="role">
                        <option value="trainer">trainer</option>
                        <option value="admin">admin</option>
                    </select>
                </div>
                <br>
                <button type="submit">CREA</button>

                @if(session('message'))
                <h1 style="color:red">{{session('message')}}</h1>
                @endif
            </form>
        </div>

    </div>



</div>



@endsection