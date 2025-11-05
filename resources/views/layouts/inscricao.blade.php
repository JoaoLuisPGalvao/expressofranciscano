<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="João Luís Pereira Galvão">
        <meta name="description" content="Sistema de inscrição do Expresso Franciscano">
        <title>@yield('title', 'Expresso Franciscano')</title>

        <!-- Meu estilo -->    
	    <link rel="stylesheet" type="text/css" href="/css/estilo.css">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  
        
        <!-- Icones Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>       

        <!-- favicon -->
       <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

       <!-- SweetAlert -->
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>       
    </head>

    <body class="sb-nav-fixed">
        <nav class="navbar navbar-expand-lg" style="background-color: #F0623C;">
            <div class="container-fluid justify-content-center">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="{{ asset('img/brand.png') }}" width="130" height="50" alt="Logo Expresso Franciscano">
                    <h3 class="ms-4 text-white mb-0">Expresso Franciscano</h3>
                </a>
            </div>
        </nav>
            
        <main class="flex-grow-1 py-4">
            <div class="container-fluid fadeIn">                
                        
                @if(session('msgErro'))
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            Swal.fire({                                            
                                icon: "error",
                                title: "Erro!",
                                text: "{{ session('msgErro') }}",
                                showConfirmButton: false,                                
                                });                                
                        })
                    </script>
                @endif        

                @if($errors->any())
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro!',
                            confirmButtonColor: "#DC3545",                                    
                            html: `
                                <ul style="text-align:left;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            `
                        });
                    </script>
                @endif

                @yield('content') 
                
            </div>
        </main>

        <footer class="footer mt-5 fixed-bottom">               
            <div class="container-fluid text-muted text-center py-1">
                <small>© 2025 Copyright: Desenvolvido por <b>João Luís Pereira Galvão</b></small>
            </div>
        </footer> 

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        
        <!-- fontawesome -->
        <script defer src="https://use.fontawesome.com/releases/v5.10.2/js/all.js"></script>

        <!-- JS do app -->
        <script src="/js/app.js"></script> 
        <script src="/js/mascaras.js"></script>  

        <!-- biblioteca jQuery Mask -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    </body>
</html>