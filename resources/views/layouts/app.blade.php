<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SENAI')</title>
    <link rel="shortcut icon" href="{{ asset('img/logo-small.png')}}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #dadadaff;
        font-family: Arial, sans-serif; }

        li { list-style: none; }
        
        .cimah i {
            cursor: pointer;
            color: white;
        }

        .cimah {
            background-color: #FF0000;
            color: white;
        }

        .cimah a{
             text-decoration: none;
        }

        .baixoh {
            background-color: #fff;
            display: flex;
            align-items: end;
            justify-content: center;
            border-bottom: #FF0000 3px solid;
            position: relative;
        }

        .baixoh a { 
            color: #242424ff; 
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
        }

        .baixoh a:hover {
            color: #FF0000;
        }

        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: white;
        }

        /* Menu Desktop - Layout original */
        .desktop-menu {
            display: flex;
            justify-content: center;
            width: 75%;
        }

        .desktop-menu .nav {
            gap: 2rem;
        }

        .desktop-menu .nav-link {
            padding: 0.5rem 0;
            position: relative;
        }

        .user-section {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 8px;
            margin-left: 2rem;
        }

        .user-section i {
            color: #000 !important;
            font-size: 1.5rem;
        }

        .user-section a span {
            display: inline;         /* força o texto ficar na mesma linha */
            white-space: nowrap;     /* impede quebra de linha automática */
        }

        /* Menu Mobile Styles */
        #navbarMenu {
            position: fixed; /* mudado de absolute para fixed */
            top: 110px; /* ajustado para considerar a altura do header */
            left: 0;
            width: 85%;
            height: calc(100vh - 110px); /* altura da viewport menos altura do header */
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            background: white;
            border-top: #FF0000 3px solid;
            border-radius: 0 0 8px 0; /* arredondar cantos */
        }

        /* Ajustar scrollbar para ficar mais discreta */
        #navbarMenu::-webkit-scrollbar {
            width: 5px;
        }

        #navbarMenu::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        #navbarMenu::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        #navbarMenu::-webkit-scrollbar-thumb:hover {
            background: #666;
        }

        /* Ajustar padding dos itens do menu */
        #navbarMenu .nav-link,
        .mobile-menu-item {
            padding: 15px 20px;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
            font-weight: 500;
        }

        #navbarMenu .nav-link:last-child {
            border-bottom: none;
        }

        #navbarMenu .nav-link:hover {
            background-color: #f8f9fa;
        }

        .mobile-menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            border-bottom: 1px solid #f0f0f0;
        }

        .mobile-menu-item:last-child {
            border-bottom: none;
        }

        /* Destaque para Mural de Vagas no mobile */
        .mural-vagas-mobile {
            background-color: transparent;
        }

        .mural-vagas-mobile .nav-link {
            color: #333 !important;
            font-weight: bold;
        }

        /* Adicionar estilo para o botão de login */
        .login-mobile {
            background-color: #FF0000;
        }

        .login-mobile .nav-link,
        .login-mobile span {
            color: white !important;
            font-weight: bold;
        }

        /* Footer styles similar to SENAI design */
        .senai-footer-top { background: #e70012; min-height: 46px; }
        .senai-footer-mid { background: #b2222b; }
        .senai-footer-mid h5 { color: #fff; }
        .senai-footer-mid p { color: #fff; opacity: 0.95; }
        .senai-footer-bottom { background: #e70012; }
        .footer-links a { text-decoration: none; }
        
        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .desktop-menu {
                display: none !important;
            }
            
            .user-section {
                display: none !important;
            }

            .baixoh .container-fluid {
                justify-content: space-between;
            }

            .logo-container {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
            }
        }

        @media (min-width: 992px) {
            .navbar-toggler {
                display: none !important;
            }
            
            #navbarMenu {
                display: none !important;
            }
        }

        @media (max-width: 768px) {
            .senai-footer-mid .row > [class*='col-'] { text-align: center; }
            
            .cimah .nav {
                gap: 0.3rem;
                flex-wrap: wrap;
                justify-content: flex-end;
            }
            
            .cimah .nav-item {
                font-size: 0.75rem;
            }
            
            .cimah i {
                font-size: 0.9rem;
            }
            .cimah a {
                text-decoration: none;
            }
        }

        @media (max-width: 576px) {
            .cimah {
                display: flex;
                padding: 0.2rem !important;
            }
            
            .baixoh {
                height: 70px;
            }
            
            .cimah .nav-item {
                font-size: 0.7rem;
            }
            
            .cimah i {
                font-size: 0.8rem;
            }
        }

        /* Botão hamburguer vermelho e à esquerda */
        .hamburger-btn {
            color: #FF0000 !important;
            font-size: 1.8rem;
        }

        /* Lupa à direita no mobile */
        .mobile-search {
            display: flex;
            align-items: center;
            margin-left: auto;
        }
    </style>

    @stack('styles')
</head>
<body>
    <header>
        <div class="container-fluid p-0">
            <!-- Header Superior -->
            <div class="cimah d-flex justify-content-end p-1"> 
                <ul class="nav flex-row gap-2">
                    <li class="nav-item fw-bold">FIESP</li>
                    <li class="nav-item fw-bold">CIESP</li>
                    <li class="nav-item fw-bold">SESI</li>
                    <li class="nav-item fw-bold">SENAI</li>
                    <li class="nav-item fw-bold">IRS</li>
                    <li class="nav-item"><a href=""><i class="bi bi-facebook"> |</i></a></li>
                    <li class="nav-item"><a href=""><i class="bi bi-twitter"> |</i></a></li>
                    <li class="nav-item"><a href=""><i class="bi bi-youtube"> |</i></a></li>
                    <li class="nav-item"><a href=""><i class="bi bi-linkedin"> |</i></a></li>
                    <li class="nav-item"><a href=""><i class="bi bi-instagram"> |</i></a></li>
                    <li class="nav-item"><a href=""><i class="bi bi-whatsapp"></i></a></li>  
                </ul>
            </div>
            
            <!-- Menu Principal -->
            <div class="baixoh" style="height:70px;">
                <div class="container-fluid d-flex align-items-end justify-content-between">
                    <!-- Botão Hamburguer vermelho (visível apenas em mobile) - SEM TEXTO "MENU" -->
                    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="bi bi-list hamburger-btn"></i>
                    </button>

                    <!-- Logo Centralizado -->
                    <div class="logo-container">
                        <a href="{{ route('pag_init')}}"><img src="{{ asset('img/senai.png') }}" alt="logo" style="height:50px; width:auto;"></a>
                    </div>
                    
                    <!-- Menu Desktop (visível apenas em desktop) -->
                    <div class="desktop-menu d-none d-md-flex">
                        <ul class="nav flex-row align-items-end mb-0">
                            <li class="nav-item"><a href="" class="nav-link fw-bold">Cursos</a></li>
                            <li class="nav-item"><a href="" class="nav-link fw-bold">Processo Seletivo</a></li>
                            <li class="nav-item"><a href="" class="nav-link fw-bold">O SENAI</a></li>
                            <li class="nav-item"><a href="" class="nav-link fw-bold">Para a sua empresa</a></li>
                            <li class="nav-item"><a href="" class="nav-link fw-bold">Unidades</a></li>
                            <li class="nav-item"><a href="" class="nav-link fw-bold">Transparência</a></li>
                            <li class="nav-item"><a href="" class="nav-link fw-bold">Fale conosco</a></li>
                        </ul>
                    </div>

                    <!-- Seção do Usuário (Desktop) -->
                    <div class="user-section d-none d-sm-flex">
                        <i class="bi bi-search"></i>
                        <span style="border-left:2px solid #222; height:24px;"></span>
                        <i class="bi bi-person"></i>
                        @if(auth()->user())
                            <a href="{{ route('pag_init') }}">
                                <span class="ms-1">{{ auth()->user()->nome }}</span>
                            </a>

                            <a href="#" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-power"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="ms-1">SOU&nbsp;ALUNO</a>
                        @endif

                    </div>

                    <!-- Lupa à direita (apenas mobile) -->
                    <div class="mobile-search d-lg-none">
                        <i class="bi bi-search" style="font-size:1.5rem; color: #000;"></i>
                    </div>

            <!-- Menu Mobile (collapse) -->
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="" class="nav-link fw-bold">Cursos</a></li>
                    <li class="nav-item"><a href="" class="nav-link fw-bold">Processo Seletivo</a></li>
                    <li class="nav-item"><a href="" class="nav-link fw-bold">O SENAI</a></li>
                    <li class="nav-item"><a href="" class="nav-link fw-bold">Para a sua empresa</a></li>
                    <li class="nav-item"><a href="" class="nav-link fw-bold">Unidades</a></li>
                    <li class="nav-item"><a href="" class="nav-link fw-bold">Transparência</a></li>
                    <li class="nav-item"><a href="" class="nav-link fw-bold">Fale conosco</a></li>
                    <li class="nav-item">
                        <a href="{{ route('mural.index')}}" class="nav-link fw-bold">Mural de Vagas</a>
                    </li>
                    <!-- Login com destaque vermelho -->
                    <li class="mobile-menu-item login-mobile">
                        <i class="bi bi-person" style="font-size:1.5rem; color: white;"></i>
                        @if(auth()->user())
                            <a href="{{ route('pag_init') }}" class="nav-link">{{ auth()->user()->nome }}</a>
                        @else
                            <a href="{{ route('login') }}" class="nav-link">SOU ALUNO</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <main class="container mt-5">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

    <footer class="mt-5">
        @stack('footer')

        <!-- Top bright red strip -->
        <div class="senai-footer-top w-100">
            <div class="container d-flex justify-content-center py-2">
                <ul class="nav flex-row gap-4">
                    <li class="nav-item"><a href=""><i class="bi bi-facebook" style="color: white;"></i></a></li>
                    <li class="nav-item"><a href=""><i class="bi bi-twitter" style="color: white;"></i></a></li>
                    <li class="nav-item"><a href=""><i class="bi bi-youtube" style="color: white;"></i></a></li>
                    <li class="nav-item"><a href=""><i class="bi bi-linkedin" style="color: white;"></i></a></li>
                    <li class="nav-item"><a href=""><i class="bi bi-instagram" style="color: white;"></i></a></li>
                    <li class="nav-item"><a href=""><i class="bi bi-whatsapp" style="color: white;"></i></a></li>  
                </ul>
            </div>
        </div>

        <!-- Middle main footer (dark red) -->
        <div class="senai-footer-mid w-100 text-white">
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h5 class="fw-bold" style="font-size: 17px;">EDIFÍCIO SEDE FIESP</h5>
                        <p class="mb-1">Av. Paulista, 1313, São Paulo/SP</p>
                        <p class="mb-0">CEP 01311-923</p>
                    </div>
                    <div class="col-md-6 mb-4">
                        <h5 class="fw-bold">CENTRAL DE RELACIONAMENTO</h5>
                        <p class="mb-1">(11) 3322-0050 (Telefone/WhatsApp)</p>
                        <p class="mb-0">0800-055-1000 (Interior de SP, somente telefone fixo)</p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <ul class="nav justify-content-center flex-wrap gap-4 footer-links">
                            <li class="nav-item"><a href="#" class="text-white fw-bold">Unidades</a></li>
                            <li class="nav-item"><a href="#" class="text-white fw-bold">O SENAI</a></li>
                            <li class="nav-item"><a href="#" class="text-white fw-bold">Perguntas Frequentes</a></li>
                            <li class="nav-item"><a href="#" class="text-white fw-bold">Fale Conosco</a></li>
                            <li class="nav-item"><a href="#" class="text-white fw-bold">Transparência</a></li>
                            <li class="nav-item"><a href="#" class="text-white fw-bold">Para a sua empresa</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom copyright bright red strip -->
        <div class="senai-footer-bottom w-100 text-white text-center py-3">
            <div class="container">
                <small>Copyright 2025 © Todos os direitos reservados.</small>
            </div>
        </div>
    </footer>
</body>
</html>