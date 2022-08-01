@extends('auth.custom_login')
@section('content')
<style>
    .btn-login {
    font-size: 0.9rem;
    letter-spacing: 0.05rem;
    padding: 0.75rem 1rem;
  }
</style>
<main class="login-form">
    <div class="container">
        <div class="row">
          <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
              <div class="card-body p-4 p-sm-5">
                <h3 class="text-center mb-5"><b>BVM Sanchez & Son</b><br>Logistics Management System</h3>
                <h4 class="card-title text-center mb-5">Sign In</h4>
                <form method="POST" action="{{ route('login.custom') }}">
                    @csrf
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Employee ID">
                    <label for="floatingInput">Username</label>
                    @if ($errors->has('username'))
                    <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                  </div>
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                  </div>
    
                  <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                    <label class="form-check-label" for="rememberPasswordCheck">
                      Remember password
                    </label>
                  </div>
                  <div class="d-grid">
                    <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Sign
                      in</button>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
</main>
@endsection