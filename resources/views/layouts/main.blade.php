<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>

        <!-- Meu estilo -->    	    
        @vite([
            'resources/css/estilo.css', 
            'resources/css/styles_sbadmin.css'
        ])       

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  
        
        <!-- Icones Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

       <!-- Data table -->
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

        <!-- favicon -->
       <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

       <!-- SweetAlert -->
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

       <!-- Charts JS -->
       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

       <!-- Select2 -->
       <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-orange" style="background-color: #F0623C;" data-bs-theme="light">

            <!-- Navbar Brand-->
            <a class="navbar-brand text-center" href="#"><img src="/img/brand.png" width="130" height="50" alt=""></a>

            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-light" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>            
            
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">  
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalAlterarSenha"><i class="bi bi-person-fill-lock me-1 fs-5"></i> Alterar senha</a></li>
                        <li><hr class="dropdown-divider"></li>                      
                        <li><a class="dropdown-item" href="{{ route('sair') }}"><i class="bi bi-door-open-fill me-1 fs-5"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-orange" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">

                        <hr class="mt-0">

                        <div class="nav">
                            @can('administrador') 
                                <a class="nav-link collapsed py-2" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdministrador" aria-expanded="false" aria-controls="collapseAdministrador">
                                    <div class="sb-nav-link-icon"><i class="bi bi-person-fill-gear fs-5"></i></div>
                                    Administrador
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseAdministrador" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link py-1" href="">- Teste</a>                                            
                                    </nav>
                                </div>
                            @endcan
                            <a class="nav-link py-2" href="{{ route('home.index') }}">
                                <div class="sb-nav-link-icon"><i class="bi bi-house fs-5"></i> </div>
                                Home
                            </a>
                            <a class="nav-link py-2" href="{{ route('encontristas.index') }}">
                                <div class="sb-nav-link-icon"><i class="bi bi-person-raised-hand fs-5"></i> </div>
                                Encontristas
                            </a>
                            @if(auth()->user()->can('administrador') || auth()->user()->can('locomotor'))
                                <a class="nav-link py-2" href="{{ route('users.index') }}">
                                    <div class="sb-nav-link-icon"><i class="bi bi-person-circle fs-5"></i> </div>
                                    Usuários
                                </a>
                            @endif
                        </div>                            
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Usuário:</div>
                        {{ auth()->user()->name }}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid p-2 fadeIn">

                        @if(session('msg'))
                            <script>
                                document.addEventListener('DOMContentLoaded', () => {
                                    Swal.fire({                                            
                                        icon: "success",
                                        title: "Sucesso!",
                                        text: "{{ session('msg') }}",
                                        showConfirmButton: false,
                                        timer: 3000
                                        });                                
                                })
                            </script>
                        @endif      
                        
                        @if(session('msgErro'))
                            <script>
                                document.addEventListener('DOMContentLoaded', () => {
                                    Swal.fire({                                            
                                        icon: "error",
                                        title: "Erro!",
                                        text: "{{ session('msgErro') }}",
                                        showConfirmButton: false,
                                        timer: 3000
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
            </div>
        </div>

       <!-- biblioteca CKEditor -->
        <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        
        <!-- Data Table -->
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
        
        <!-- fontawesome -->
        <script defer src="https://use.fontawesome.com/releases/v5.10.2/js/all.js"></script>

        <!-- JS do app -->
        @vite([
            'resources/js/app.js',
            'resources/js/mascaras.js', 
            'resources/js/scripts_sbadmin.js'
        ])
        
        @stack('grafico')   

        <!-- biblioteca jQuery Mask -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

        <!-- Full Calendar -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

        <!-- Select2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

        @include('users/modal_alterar_senha')         
    </body>
</html>