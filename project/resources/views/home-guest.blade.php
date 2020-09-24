<div class="reg-index-container">
    <div class="jumbo row d-flex justify-content-around">

        <div class="jumbo-sx col-xs-12 col-md-4">
             <img class ="jumbo-scritta" src="https://fontmeme.com/permalink/200923/26b5b7ff9bc8f8541695cabd23aa7b1b.png" alt="font-pokemon" border="0">
        </div>
        <div class="jumbo-dx col-xs-12 col-md-6 col-lg-4">
            <div class="card card-outline-secondary">
                <div class="card-header">
                    <h3 class="mb-0">Registrati</h3>
                </div>
                <div class="card-body">
                    <form class="form" role="form" autocomplete="off" action="{{ route('register') }}" method="post">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Full name" name="name" required>
                        </div>
                    
                        <div class="form-group">
                            <label for="inputPassword3">Password</label>
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Password" required="" name="password">
                        </div>
                        <div class="form-group">
                            <label for="inputVerify3">Verifica password</label>
                            <input type="password" class="form-control" id="inputVerify3" placeholder="Password (again)" required="" name="password_confirmation">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg float-right">Registrati</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Default form login -->
{{-- <form class="text-center flex-shrink border border-light p-5" action="{{ route('register') }}" method="POST">
@method('POST')
@csrf
<p class="h4 mb-4">Registrati</p>

<!-- Nome -->
<input type="text" name="name" id="defaultLoginFormName" class="form-control mb-4" placeholder="Nome">

<!-- Password -->
<input type="password" name="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password">

<!-- Password -->
<input type="password" name="password_confirmation" id="defaultLoginFormRepeatPassword" class="form-control mb-4"
    placeholder="Ripeti Password">

<div class="d-flex justify-content-around">
    <div>
        <!-- Remember me -->
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
            <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
        </div>
    </div>
    <div>
        <!-- Forgot password -->
        <a href=""> Password dimenticata?</a>
    </div>
</div>

<!-- Sign in button -->
<button class="btn btn-info btn-block my-4" type="submit">Registrati</button>

<!-- Register -->
<p>Sei già registrato?
    <a href="{{route('login_form')}}">Login</a>
</p>

<!-- Social login -->
<p>or sign in with:</p>

<a href="#" class="mx-2" role="button"><i class="fab fa-facebook-f light-blue-text"></i></a>
<a href="#" class="mx-2" role="button"><i class="fab fa-twitter light-blue-text"></i></a>
<a href="#" class="mx-2" role="button"><i class="fab fa-linkedin-in light-blue-text"></i></a>
<a href="#" class="mx-2" role="button"><i class="fab fa-github light-blue-text"></i></a>


@if($errors->any())
<smal lclass="text-muted" style="color:red">{{$errors->first()}}</small>
    @endif
    </form> --}}