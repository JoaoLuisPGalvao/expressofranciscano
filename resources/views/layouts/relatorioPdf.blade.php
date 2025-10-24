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
                margin-bottom: 20px;
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
                margin-bottom: 15px;
            }

            td {
                padding: 6px;
                vertical-align: top;
            }

            .label {
                font-weight: bold;
                width: 25%;
            }

            .foto {
                text-align: center;
                border: 1px solid #ccc;
                width: 120px;
                height: 150px;
                object-fit: cover;
            }

            .foto-box {
                text-align: center;
                border: 1px solid #aaa;
                width: 120px;
                height: 150px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #777;
                font-size: 12px;
            }
            
            .section-title {
                font-weight: bold;
                background: #eee;
                padding: 4px;
                margin-top: 10px;
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
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    </body>

</html>