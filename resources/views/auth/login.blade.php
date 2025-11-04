<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/logo-small.png')}}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Senai - Login</title>
    <style>
        body {
            overflow-x: hidden;
            background-color: #d5d5d5;
            font-family: Arial, sans-serif;
        }

        .login-container {
            background-image: url('{{ asset('img/fundo-form.jpg') }}');
            background-size: cover;
            background-position: center;
            min-height: calc(100vh - 120px);
            padding: 2rem;
        }

        .login-content {
            max-width: 450px;
            margin: 0 auto;
            padding: 2rem;
            background: rgba(255,255,255,0.95);
            border-radius: 10px;
        }

        .form-input {
            width: 100%;
            max-width: 300px;
            height: 40px;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn-login {
            background-color: #D8240B;
            color: white;
            font-weight: bold;
            padding: 8px 24px;
            border: none;
            border-radius: 4px;
            width: auto;
            min-width: 120px;
        }

        /* Estilos do menu hamburguer */
        .header-menu {
            position: relative;
            padding: 0;
            height: 50px;
            background-color: #d5d5d5;
        }

        .menu-toggle-btn {
            display: none;
            width: 50px;
            height: 50px;
            border: none;
            background: #d5d5d5;
            color: #333;
            font-size: 1.4rem;
            cursor: pointer;
            position: absolute;
            left: 0;
            top: 0;
            z-index: 1002;
            transition: color 0.3s;
        }

        .menu-toggle-btn:hover {
            color: #D8240B;
        }

        .header-links {
            display: flex;
            gap: 2rem;
            margin-left: 60px;
        }

        @media (max-width: 768px) {
            .menu-toggle-btn {
                display: flex;
                align-items: center;
                justify-content: center;

            }

            .header-links {
                display: none;
                position: fixed;
                top: 50px; /* Espaço para o botão */
                left: 0;
                width: 50px;
                height: 50px;
                background: white;
                flex-direction: column;
                padding: 0;
                z-index: 1001;
                box-shadow: 2px 0 5px rgba(0,0,0,0.1);
                margin-left: 0;
                overflow-y: auto; /* Permite scroll vertical */
                transition: all 0.3s ease;
            }

            .header-links.active {
                display: flex;
                width: 150px;
                height: 200px; /* Altura maior para mostrar scroll */
                padding: 8px;
                justify-content: flex-start; /* Alinha itens ao topo */
                gap: 5px; /* Espaço entre links */
            }

            .header-links a {
                padding: 8px;
                font-size: 12px;
                text-align: left;
                width: 100%;
                border-bottom: 1px solid #eee;
                margin: 0 !important;
                white-space: nowrap;
                display: block;
                min-height: 35px; /* Altura mínima para cada link */
            }

            .header-links a:last-child {
                border-bottom: none;
            }
        }

    </style>
</head>
<body>
    <!-- Header com menu hamburguer -->
    <header class="header-menu">
        <button class="menu-toggle-btn" onclick="toggleHeaderMenu()">
            <i class="bi bi-list"></i>
        </button>
        
        <div class="header-links" id="headerLinks">
            <a href="https://www.fiesp.com.br/" target="_blank"><i>FIESP</i></a>
            <a href="https://www.ciesp.com.br/" target="_blank"><i>CIESP</i></a>
            <a href="https://www.sesisp.org.br/" target="_blank"><i>SESI</i></a>
            <a href="https://www.sp.senai.br/" target="_blank"><i>SENAI</i></a>
            <a href="http://fiesp.com.br/instituto-roberto-simonsen-irs/" target="_blank"><i>IRS</i></a>
        </div>
    </header>

    <div class="login-container">
        <div class="login-content text-center">
            <h1 class="mb-0" style="font-size: 15px;">Bem-Vindo ao</h1>
            <h2 class="mb-3" style="color: #D8240B; font-size: 28px; font-weight: bold;"><i>PORTAL EDUCACIONAL</i></h2>
            <img src="{{ asset('img/sesisenai.png') }}" class="mb-4 img-fluid" style="max-width: 40%;" alt="Logo">
            
            <form method="POST" action="{{ route('login') }}" class="text-start">
                @csrf
                <h5 class="mb-4">FAÇA LOGIN E CONHEÇA AS NOVIDADES.</h5>
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="mb-3">
                    <label for="cpf" class="form-label">Digite seu CPF: *</label>
                    <input type="text" class="form-input" name="cpf" id="cpf" placeholder="___.___.___-__">
                </div>

                <div class="mb-4">
                    <label for="senha" class="form-label">Digite sua Senha: *</label>
                    <input type="password" class="form-input" name="senha" id="senha" placeholder="********">
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="bi bi-arrow-up-right-square"></i> ENTRAR
                </button>
            </form>
        </div>
    </div>

    <footer class="py-3" style="background-color: #d5d5d5;">
        <div class="d-flex justify-content-center align-items-center">
            <p class="mb-0" style="font-size: 11px;">
                Copyright 2015-2018 © Todos os direitos reservados. | O conteúdo do site sesisenaisp.org.br não pode ser editado, copiado ou distribuído sem expressa autorização do Sesi-SP e Senai-SP.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
        function toggleMenu() {
            document.getElementById('menuMobile').classList.toggle('active');
        }

        function toggleFooter() {
            document.getElementById('footerMobile').classList.toggle('active');
        }

        function toggleHeaderMenu() {
            document.getElementById('headerLinks').classList.toggle('active');
        }

        // Fecha menus ao clicar fora
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.menu-mobile') && 
                !event.target.closest('.menu-toggle') &&
                !event.target.closest('.footer-mobile') && 
                !event.target.closest('.footer-toggle') &&
                !event.target.closest('.header-links') && 
                !event.target.closest('.menu-toggle-btn')) {
                document.getElementById('menuMobile').classList.remove('active');
                document.getElementById('footerMobile').classList.remove('active');
                document.getElementById('headerLinks').classList.remove('active');
            }
        });
    </script>
</body>
</html>