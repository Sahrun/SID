@extends('layouts.app')
@section('content')
<div class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h3 class="text-center">Sign In </h3>
			<form method="post" action="{{ route('login') }}">
				@csrf
				<div class="login-form">
					<div class="form-group form-floating-label">
						<input id="email" name="email" type="email" 
							class="form-control input-border-bottom @error('email') is-invalid @enderror" 
							value="{{ old('email') }}" autocomplete="email" autofocus required>
						<label for="email" class="placeholder">{{ __('E-Mail Address') }}</label>
					</div>
					@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					<div class="form-group form-floating-label">
						<input id="password" name="password" type="password" 
							class="form-control input-border-bottom @error('password') is-invalid @enderror" 
							required autocomplete="current-password">
						<label for="password" class="placeholder">{{ __('Password') }}</label>
					</div>
					@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					<div class="row form-sub m-0">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="remember"
								name="remember" {{ old('remember') ? 'checked' : '' }}>
							<label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
						</div>
						@if (Route::has('password.request'))
							<a href="{{ route('password.request') }}" class="link float-right">
								{{ __('Forgot Your Password?') }}
							</a>
						@endif
					</div>
					<div class="form-action mb-3">
						<button type="submit" class="btn btn-primary btn-rounded btn-login">{{ __('Login') }}</button>
					</div>
					<div class="login-account">
					@if (Route::has('register'))
						<span class="msg">Don't have an account yet ?</span>
							<a href="{{ route('register') }}" id="show-signup" class="link">{{ __('Register') }}</a>
						</div>
					@endif
				</div>
			</form>
		</div>
	</div>
</div>
@stop