<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <title>Document</title>
    
</head>
<body>
     <header class="header">
        <div class="container">
            <h1 class="header-title">Sistema de Filas SUS</h1>
            <p class="header-subtitle">Gerenciamento de Atendimento Público</p>
        </div>
    </header>

    <hr>
    
    <main class="main">
        <div class="container">
            @yield('context')
        </div>
    </main>
    <hr>

     <footer class="footer">
        <div class="container">
            <p class="footer-title">Sistema Único de Saúde - SUS</p>
            <p class="footer-subtitle">Saúde é um direito de todos</p>
            <p class="footer-subtitle">&copy; 2026 - Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>