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
