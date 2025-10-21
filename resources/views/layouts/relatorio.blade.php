<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    

        <!-- Meu estilo -->    
	    <link rel="stylesheet" type="text/css" href="/css/estilo.css"> 
        
         <!-- favicon -->
       <link rel="icon" type="/image/png" href="{{ asset('favicon.png') }}">
    </head>
    <body class="customText">
        <div class="conteiner-fluid">
            <div class="row-fluid">
                @yield('content')                                    
            </div>
        </div>   
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    </body>
</html>