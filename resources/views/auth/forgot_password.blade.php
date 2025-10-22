@extends('layouts.login')

@section('title', 'Recuperar a senha')

@section('content')

	<div class="form-signin text-center">
    	<img src="/img/banner.jpg" alt="Logo Expresso Franciscano" class="brand-logo img-fluid mb-4" style="max-width: 200px;">

    	<h5 class="mb-4 fw-semibold">Recuperar a Senha</h5>

		@if($errors->any())
			<div class="alert alert-danger text-start" role="alert">
				@foreach($errors->all() as $error)
					<div><i class="bi bi-exclamation-octagon-fill me-1"></i> {{ $error }}</div>
				@endforeach
			</div>
		@endif

		<form method="POST" action="{{ route('password.email') }}">
			@csrf

			<div class="form-floating mb-4">
				<input type="email" class="form-control shadow-sm" id="floatingInput" name="email" placeholder="E-mail" value="{{ old('email') }}">
				<label for="floatingInput">E-mail</label>
			</div>

			<div class="d-flex justify-content-between gap-2">
				<a class="btn btn-outline-secondary w-50" href="{{ route('index') }}">
					<i class="bi bi-box-arrow-in-right me-1"></i> Login
				</a>
				<button class="btn btn-primary w-50" type="submit">
					<i class="bi bi-person-lock me-1"></i> Recuperar
				</button>
			</div>
		</form>
	</div>
	
@endsection