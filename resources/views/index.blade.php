@extends('layouts.login')

@section('title', 'Expresso Franciscano - Login')

@section('content')

<div class="form-signin text-center">
	<img src="/img/banner.jpg" alt="Logo Expresso Franciscano" class="brand-logo img-fluid mb-4" style="max-width: 200px;">       

	<h5 class="mb-4 fw-semibold">Faça login na sua conta</h5>

	@if($errors->any())
		<div class="alert alert-danger text-start" role="alert">
			@foreach($errors->all() as $error)
				<div><i class="bi bi-exclamation-octagon-fill me-1"></i> {{ $error }}</div>
			@endforeach
		</div>
	@endif

	@if (session('success'))
		<div class="alert alert-success text-start" role="alert">
			<i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
		</div>
	@endif

	<form method="POST" action="{{ route('store') }}"> 
		@csrf

		<div class="form-floating mb-3">
			<input type="email" class="form-control shadow-sm" id="floatingInput" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
			<label for="floatingInput">E-mail</label>
		</div>

		<div class="form-floating mb-3">
			<input type="password" class="form-control shadow-sm" id="floatingPassword" name="password" placeholder="Senha" required>
			<label for="floatingPassword">Senha</label>
		</div>

		<div class="d-flex justify-content-center mb-3">
			{!! NoCaptcha::renderJs() !!}
			{!! NoCaptcha::display() !!}
		</div>

		<button id="btnEntrar" class="btn btn-outline-primary btn-lg w-100 shadow-sm rounded-pill mb-3" type="submit">
			<i class="bi bi-box-arrow-in-right me-1"></i> Entrar
		</button>

		<div class="text-center">
			<a href="{{ route('password.request') }}" class="text-decoration-none">Esqueceu a senha?</a>
		</div>
	</form>
</div>

<script>
	document.getElementById("btnEntrar").addEventListener("click", function () {
		let btn = this;

		// desabilita para evitar múltiplos cliques
		btn.disabled = true;

		// troca conteúdo do botão
		btn.innerHTML = `
			<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
			Entrando...
		`;
		
		// aguarda 3 segundos e então envia o formulário
		setTimeout(() => {
        	btn.closest("form").submit();
      		}, 3000);
	});
</script>
@endsection
