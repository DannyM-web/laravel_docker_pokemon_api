@extends('template')

@section('content')
    

<div id="login">
       
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="{{route('authenticate')}}" method="post">
                        @method('POST')
                        @csrf
                        <h3 class="text-center text-info">Login</h3>
                        @if($errors->any())
                        <h6>{{$errors->first()}}</h6>
                        @endif
                        @if (session('message'))
                        <h6>{{session('message')}}</h6>
                        @endif
                        <div class="form-group">
                            <label for="username" class="text-info">Username:</label><br>
                            <input type="text" name="name" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="text" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                        </div>
                        <div id="register-link" class="text-right">
                            <a href="{{route('register_form')}}" class="text-info">Registrati qui</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
