<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>@yield('title')</title>

		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- Icones Bootstrap -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

		<!-- Favicon -->
		<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

		<!-- Custom CSS -->
		<style>
			body, html {
				height: 100%;
				width: 100%;
				margin: 0;
				font-family: Arial, sans-serif;
				display: flex;
				justify-content: center;
				align-items: center;
				background-color: #f5f5f5;
			}

			.container-fluid {
				height: 100vh;
				display: flex;
			}

			/* Esquerda - Imagem de fundo */
			.login-left {
				background-image: url('/img/fundo_login.png');
				background-size: cover;
				background-position: center;
				flex: 1;
				display: none;
			}

			/* Direita - Formulário de Login */
			.login-right {
				display: flex;           
				justify-content: center;
				background-color: #ffffff;
				padding: 2rem;
				width: 100%;            
				box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
			}

			.form-signin {
				width: 100%;
				max-width: 400px;
			}

			.brand-logo {
				width: 200px;
				height: 200px;
				margin-bottom: 1rem;
			}        

			@media (min-width: 900px) {
				.login-left {
					display: block;
					width: 60%;
				}

				.login-right {
					width: 40%;
					max-width: 400px;
					padding: 2rem;
				}
			}
		</style>
	</head>
	<body>
		<div class="container-fluid">
			<!-- Left side with background image -->
			<div class="login-left"></div>

			<!-- Right side with login form -->
			<div class="login-right">				
				@yield('content')
			</div>
		</div>

		<!-- Bootstrap JS (Optional) -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>