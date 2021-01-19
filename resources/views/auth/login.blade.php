@extends('fontend.layouts.guest')
@section('content') 
    <section class="breadcrumb-section mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> {{ __('layout.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('profile') }}">{{ __('layout.member') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('layout.Login') }}</li>
                      </ol>
                    </nav>                     
                </div>
            </div>
        </div>
    </section>
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('layout.credential') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('layout.email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> ( hoalamreal@gmail.com )
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('layout.password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> ( Hn123456. )
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('layout.RememberMe') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('layout.Login') }}
                                </button>
                                <a href="{{ route('login.provider', 'google') }}" class="btn btn-secondary">{{ __(' Demo Login with Google ') }}</a> 
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ url('paswordforget') }}">
                                        {{ __('layout.ForgotYourPassword') }} ?
                                    </a>
                                @endif
                            </div>
                        </div>                       
                    </form>
                </div>
            </div>
        </div>
    </div>
     
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="form-group row mb-0">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('layout.haveaccount') }}?</label>
                <div class="col-md-6 col-form-label">
                    <a href="{{ url('https://id.idshare.info/register') }}">{{ __('layout.signup') }}</a>
                </div>
             
            </div>
        </div>
    </div>
    
</div>
@endsection