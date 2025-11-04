<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    

        <style> 

            body {
            font-family: 'Times New Roman', serif;
            font-size: 14px;
            color: #000;
            }

            .header {
                border-bottom: 2px solid #000;
                margin-bottom: 5px;
                padding-bottom: 8px;
            }

            .header .logo {
                height: 100px;
            }

            .header h2 {
                font-size: 26px;
                margin: 0;
                padding-left: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 5px;
                text-align: center;
            }   

            td {
                padding: 5px;
                vertical-align: top;
            }

            .footer {
                position: fixed;
                bottom: -20;
                left: 0;
                right: 0;
                border-top: 1px solid #ccc;
                padding: 5px 15px;
                font-size: 9px;
                color: #555;
            }

            .page-number:before {
                content: counter(page);
            }

        </style>
        
         <!-- favicon -->
       <link rel="icon" type="/image/png" href="{{ asset('favicon.png') }}">

    </head>

    <body>
        <div class="conteiner-fluid">
            <div class="row-fluid">
                @yield('content')                                    
            </div>
        </div>   

        <div class="footer">
            @yield('footer')
        </div>

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    </body>
</html>