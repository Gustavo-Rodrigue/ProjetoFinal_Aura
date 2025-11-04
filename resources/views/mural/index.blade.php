<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('title', 'Página Inicial')

@push('styles')
<style>
  /* hr existente */
  hr {
    border: none;
    height: 1.5px;
    background-color: #000000ff;
  }

  .texto{
    font-size: 12px;
    position: relative;
    margin-left: 200px;
    margin-top: 420px;
  }

  /* Barra de pesquisa grande */
.search-wrapper {
  width: 100%;
  max-width: 1200px; /* aumentado para campo maior em telas largas */
  flex: 1;
}
.search-input {
  min-width: 860px; /* garante largura mínima agradável */
  max-width: 100%;
  flex: 1 1 auto;
  border-radius: 30px 0 0 30px;
  border: 1px solid #d9d9d9;
  padding: 14px 18px;
  height: 48px;
}
  .search-btn {
    background: #f5f5f5;
    border: 1px solid #d9d9d9;
    border-left: none;
    border-radius: 0 30px 30px 0;
    height: 48px;
    padding: 0 18px;
  }
  .filter-btn {
    color: #333;
    border-radius: 30px;
    background: #f5f5f5;
    border: 1px solid #d9d9d9;
    padding: 10px 20px;
    height: 48px;
  }

  /* Linha de cartões */
  .vacancy-row { display: flex; gap: 20px; flex-wrap: wrap; margin-top: 10px; }
  .vacancy-col { flex: 1 1 calc(50% - 10px); min-width: 280px; }

  /* Cartão com imagem de fundo */
  .vacancy-card {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    height: 500px; /* reduzido */
    background-size: cover;
    background-position: center;
    box-shadow: 0 6px 14px rgba(0,0,0,0.07);
  }
  /* Overlay sutil: reduz opacidade para deixar a imagem mais visível.
     Se preferir sem overlay, comente/remova esta regra. */
  /* .vacancy-card::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, rgba(255,255,255,0.28) 65%, rgba(0,0,0,0.08) 100%);
    pointer-events: none;
  } */

  /* Caixa branca com informações (à direita) */
  .info-box {
    margin-right: 10px; 
    min-height:270px; 
    margin-top: 20px; 
    padding:8px; 
    max-width: 400px; 
    min-width: 340px;
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    background: #ffffff;
    width: 300px;
    max-width: 44%;
    padding: 12px 16px;
    border-radius: 10px;
    box-shadow: 0 6px 14px rgba(0,0,0,0.10);
    z-index: 2;
    font-size: 13px;
    color: #222;
    overflow: hidden; /* evita que o conteúdo vaze do box */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.info-box h5 {
    color: #e50914;
    font-weight: 700;
    font-size: 14px;
    margin-bottom: 8px;
}
.info-box hr {
    margin: 8px 0;
    border: none;
    height: 1px;
    background: #e6e6e6;
}
.info-box p {
    margin: 4px 0;
    line-height: 1.4;
}

  /* Botão vermelho menor no canto inferior esquerdo do cartão */
  .vacancy-cta {
    position: absolute;
    left: 12px;
    bottom: 12px;
    background: #e50914;
    border-color: #e50914;
    color: #fff;
    padding: 8px 12px;
    border-radius: 8px;
    z-index: 3;
    font-weight: 600;
    text-decoration: none;
    font-size: 13px;
  }


  /* Centraliza modal e form */
  .modal-dialog-centered { display: flex; align-items: center; min-height: calc(100% - 1rem); }
  .modal-content.centered {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0;
    border-radius: 10px;
    max-width: 560px;
    width: 100%;
  }
  /* torna o header relativo para permitir título absoluto centralizado */
  .modal-header.centered {
    position: relative;
    width: 100%;
    border-bottom: none;
    padding: 1rem 1.25rem 0.25rem;
  }
  /* título central absoluto */
  .modal-title.centered {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    margin: 0;
    font-weight: 700;
  }
  /* botão fechar posicionado no canto direito sem deslocar o título */
  .modal-header.centered .btn-close {
    position: absolute;
    right: 12px;
    top: 12px;
  }

  .modal-body { width: 100%; padding: 0.75rem 1.25rem 1rem; display: flex; justify-content: center; }
  .modal-body form { width: 100%; max-width: 480px; display:flex; flex-direction:column; gap:12px; }

  .modal-body .form-group label { font-weight: 600; margin-bottom: 6px; }
  .modal-body .form-group input[type="text"],
  .modal-body .form-group input[type="email"],
  .modal-body .form-group input[type="file"],
  .modal-body .form-group input[type="tel"] {
    width: 100%;
    padding: 8px 10px;
    border-radius: 7px;
    border: 1px solid #cfcfcf;
    background-color: #e9e9e9;
  }

  .modal-footer.centered { width: 100%; justify-content: center; padding: 0.5rem 1.25rem 1rem; border-top: none; }

  /* Regras do menu / header (padronizadas com informacoes/index) */
  .menu-links {
      display: flex;
      list-style: none;
      justify-content: space-around;
      align-items: center;
      gap: 10px;
      padding-top: 15px;
      margin: 0 40px;
      font-weight: bold;
  }
  .menu-links li { color: #000; font-weight: bold; }
  .menu-links li a { color: #000; text-decoration: none; }
  .menu-links li.separator { font-weight: bold; }

  /* Forçar títulos do header/layout em negrito (aplica-se ao layout caso exista navbar) */
  .navbar .navbar-brand,
  .navbar .nav-link,
  header h1,
  header .titulo,
  .menu-links li a {
      font-weight: 700 !important;
  }

  

    /* Cards */
    .vacancy-col {
        flex: 1 1 calc(50% - 10px);
        min-width: 280px;
    }

    @media (max-width: 991px) {
        
        .vacancy-col { flex-basis: 100%; margin-left:0 !important; }
        .vacancy-card {
            height: 200px !important;
            padding: 14px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .vacancy-cta { position: static !important; display: inline-block; margin-top: 8px; }
        /* Ajusta o p de informações adicionais para ficar abaixo da info-box */
        .vacancy-card > div > p {
            position: static !important;
            margin-left: 0 !important;
            margin-top: 10px !important;
            font-size: 12px;
        }
        .menu-links {
            flex-direction: column;
            align-items: flex-start;
            margin: 0 10px !important;
            gap: 8px;
            padding-left: 0;
        }
        .menu-links li a {
            display: block;
            border-bottom: 1.5px solid #000;
            width: 100%;
        }
        .menu-links li.separator { display: none; }

        /* Info box com maior especificidade para sobrescrever outros estilos */
        .vacancy-card .info-box,
        .info-box.d-flex {
            position: static !important;
            transform: none !important;
            width: 90% !important; /* largura relativa ao card */
            min-width: 0 !important; /* remove min-width */
            max-width: none !important;
            margin: 8px auto !important;
            padding: 10px !important;
            min-height: 0 !important;
            max-height: 200px !important;
            overflow-y: auto !important;
            background: white !important;
            border-radius: 8px !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
        }
        hr {
            display: none;
            visibility: hidden;
        }
    }

    /* Busca e botão filtro */
    @media (max-width: 768px) {
        .search-input{
            min-width: 80px !important;
            max-width: 180px !important;
        }

        form.d-flex {
            flex-direction: column !important;
            align-items: stretch !important;
        }
        form.d-flex input.form-control {
            width: 100% !important;
            margin-bottom: 10px;
        }
        form.d-flex button.btn {
            width: 100% !important;
        }
        h1{
            margin-top: 15px;
        }

        .texto{
            margin-top: 0;
            margin-left: 0;
            text-align: right;
            font-size: 10px;
        }
        /* Layout e containers */
        .vacancy-col,
        .col-sm-5 {
            flex: 0 0 100% !important;
            max-width: 100% !important;
            padding: 0 15px !important;
            margin: 0 0 18px 0 !important;
        }

        .container {
            padding-right: 15px;
            padding-left: 15px;
        }

        /* Menu mobile */
        .menu-links {
            flex-direction: column;
            align-items: flex-start;
            margin: 0 10px !important;
            gap: 8px;
            padding-left: 0;
            font-size: 0.95rem;
        }

        .menu-links li a {
            display: block;
            padding-bottom: 6px;
            border-bottom: 1.5px solid #000;
            width: 100%;
        }

        .menu-links li.separator {
            display: none;
        }

        /* Cards e info-box */
        .vacancy-card {
            margin-top: 5px;
            height: auto !important;
            min-height: 160px !important;
            padding: 12px !important;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            gap: 0px;
        }

        .info-box {
            position: static !important;
            transform: none !important;
            max-width: 300px !important;
            min-width: 100px !important;
            padding: 8px 10px !important;
            margin: 8px auto !important;
            border-radius: 8px !important;
            box-shadow: 0 6px 12px rgba(0,0,0,0.06) !important;
            font-size: 13px !important;
            word-wrap: break-word !important;
            white-space: normal !important;
            max-height: 120px !important;
            min-height: 100px !important;
            overflow-y: auto !important;
        }

        .info-box h5 { 
            font-size: 13px !important; 
            margin-bottom: 6px !important; 
        }
        
        .info-box p { 
            font-size: 12px !important; 
            margin-bottom: 6px !important; 
        }

        /* Informações adicionais */
        .vacancy-card > div > p,
        .additional-info {
            position: static !important;
            margin: 8px 12px !important;
            padding: 0 !important;
            text-align: right !important;
            font-size: 11px !important;
            white-space: normal !important;
            word-break: break-word !important;
            overflow-wrap: anywhere !important;
        }

        /* Botões */
        .btn,
        .filter-btn {
            margin: 6px 0 !important;
            height: 44px !important;
        }

        /* Modal */
        .modal-dialog-centered { 
            display: flex; 
            align-items: center; 
            min-height: calc(100% - 1rem); 
        }
        
        .modal-content.centered { 
            max-width: 92%; 
            width: 100%; 
        }
        .modal-title.centered{
            text-align: center;
            font-size: 1rem !important;
            margin-bottom: ;
        }
        .botoes{
            gap: 0 !important;
        }
    }



/* Desktop apenas */
@media (min-width: 992px) {
    .col-sm-5 {
        margin-bottom: 30px;
        margin-right: 30px;
    }
    .col-sm-5:nth-child(2n) {
        margin-right: 0;
    }
}


</style>
@endpush


@section('content')
    <div class="container mt-4" style="background-color: #ffffffff; border-radius: 15px; padding: 20px;">
        <div>
            <div class="estagio">
                <ul class="menu-links">
                    <li><a href="{{ route('informacoes.index') }}">Informações</a></li>
                    <li class="separator">|</li>
                    <li><a href="{{ route('mural.index') }}">Mural de oportunidades</a></li>
                    <li class="separator">|</li>
                    <li><a href="{{ route('documento_estagio.index') }}">Documentos de Estágio</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <h1 style="font-weight: bold;">Mural de Oportunidades</h1>
            <div class="d-flex flex-column gap-2">
                <p style="font-weight: bold;">A escola atua apenas como intermediária na divulgação das oportunidades de estágio, emprego e aprendizagem, não se responsabilizando pelos critérios de seleção definidos pelas empresas.</p>
                <p style="font-weight: bold;">Para as vagas de estágio, é imprescindível que o estudante leia atentamente o Manual de Estágio (Encontrado em <a href="{{ route('documento_estagio.index') }}" style="color: #ff0000;">Documentos de Estágio</a>) antes de comparecer à empresa.</p>
                <p style="font-weight: bold;">Além disso, recomenda-se procurar o Orientador de Estágios para receber as orientações necessárias quanto aos procedimentos e documentos exigidos.</p>
            </div>
        </div>
        <hr>
        <form method="GET" class="d-flex align-items-center gap-3 mb-4">
            <!-- Campo de pesquisa com lupa (input + botão lado a lado) -->
            <div class="search-wrapper me-3">
                <input type="search" name="busca" id="busca" class="search-input" placeholder="Pesquise aqui...">
                <button type="submit" class="search-btn" aria-label="Pesquisar"><i class="bi bi-search"></i></button>
            </div>

            <!-- Botão de filtro -->
            <button type="button" class="filter-btn" data-bs-toggle="modal" data-bs-target="#modalFiltro">
                <i class="bi bi-funnel-fill"></i> Filtrar
            </button>
        </form>

        <!-- cards de vagas -->
        <?php $mensagem = ''; ?>
        <div class="row justify-content-center">
            <?php $mensagem = ''; ?>
            @if(session('mensagem'))
              <div class="alert {{ session('tipo') }}">
                {{ session('mensagem') }}
              </div>
            @endif
            @foreach($vagas as $vaga)
                <div class="col-sm-5" style="background-color: #d9d9d9; padding: 10px; border-radius: 7px;">
                    <div class="vacancy-card" style="background-image: url('{{ asset('img/fundo_card.jpg') }}');">
                        <div class="info-box d-flex align-items-start justify-content-start">
                            <h5>
                                <?php
                                    if($vaga->visibilidade==0){
                                        $visibilidade = 'Vaga não publicada';
                                    } else {
                                        $visibilidade = '';
                                    }
                                ?>
                                @if(auth()->check() && auth()->user()->conta=='admin' && $vaga->visibilidade==0)
                                    <i class="bi bi-pin-angle" style="font-size: 25px;"></i>
                                    {{ $vaga->tipo }} - {{ $vaga->titulo }} - <?php echo htmlspecialchars($visibilidade) ?>
                                @else
                                    {{ $vaga->tipo }} - {{ $vaga->titulo }}
                                @endif
                            </h5>
                            <hr>
                            <p><strong>Requisitos:</strong> {{ $vaga->requisitos }}</p>
                            <p><strong>Atividades:</strong> {{ $vaga->atividades }}</p>
                        </div>
                        <p class="texto">
                            <strong>Informações adicionais</strong><br>
                            <strong>{{ $vaga->empresa }}</strong><br>
                            <strong>Telefone para contato:</strong> {{ $vaga->telefone }}<br>
                            <strong>Publicado em:</strong> {{ $vaga->publicacao }}
                            <input type="hidden" value="{{ $vaga->responsavel }}">
                        </p>
                    </div>

                    {{-- Botões de ação --}}
                    @if(auth()->check())
                        @if(auth()->user()->tipo == 'aluno')
                            <button class="btn btn-danger mt-2 ms-2" data-bs-toggle="modal" data-bs-target="#modalTrabalho-{{ $vaga->id }}">
                                Entrar em contato
                            </button>
                        @else
                            <div class="d-flex flex-column gap-2 botoes w-100">
                                <button class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#modalTrabalho-{{ $vaga->id }}">
                                    Entrar em contato
                                </button>
                                <div class="d-flex gap-1 justify-content-between">
                                    <button class="btn btn-warning w-50" data-bs-toggle="modal" data-bs-target="#modalEditarVaga-{{ $vaga->id }}">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </button>
                                    <form class="w-50" action="{{ route('vaga.excluir', $vaga->id) }}" method="POST" class="flex-grow-1" onsubmit="return confirm('Tem certeza que deseja excluir esta vaga?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger excluir w-100" type="submit">
                                            <i class="bi bi-trash"></i> Excluir
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-danger mt-2 ms-2">Entrar em contato</a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>




    <!-- modals -->
    @foreach($vagas as $vaga)
        @if($vaga->tipo != 'ESTAGIO')
            <?php $tipo = 'Emprego'; ?>
        @else
            <?php $tipo = 'Estágio'; ?>
        @endif
            <!-- Modal exclusivo para esta vaga -->
            <div class="modal fade" id="modalTrabalho-{{ $vaga->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content centered" role="document" style="background-color: #e9e9e9;">
                        <div class="modal-header centered">
                            <h5 class="modal-title centered mt-4">Enviar dados <?php echo $tipo ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('cadastrar') }}" enctype="multipart/form-data"  class="p-0">
                                @csrf
                                <div class="form-group mb-2 d-flex flex-column">
                                    <label for="nome">Nome:</label>
                                    <input name="nome" id="nome" type="text" value="{{ auth()->user()->nome ?? '' }}" placeholder="Digite aqui..." required>
                                </div>
                                <div class="form-group mb-2 d-flex flex-column">
                                    <label for="email">Email:</label>
                                    <input name="email" id="email" type="email" placeholder="Digite aqui..." required>
                                </div>
                                <div class="form-group mb-2 d-flex flex-column">
                                    <label for="telefone">Telefone:</label>
                                    <input name="telefone" id="telefone" type="tel" placeholder="Digite aqui..." required>
                                </div>
                                <div class="form-group mb-2 d-flex flex-column">
                                    <label for="atuacao">Área de atuação:</label>
                                    <input name="atuacao" id="atuacao" type="text" placeholder="Digite aqui..." required>
                                </div>
                                <div class="form-group mb-2 d-flex flex-column">
                                    <label for="curriculo">Envie seu currículo:</label>
                                    <input name="curriculo" id="curriculo" type="file" required>
                                </div>
                                <input type="hidden" name="id_aluno" value="{{ auth()->id() }}">
                                <input type="hidden" name="id_vaga" value="{{ $vaga->id ?? 0 }}">
                                <input type="hidden" name="email_vaga" value="{{ $vaga->email ?? '' }}">
                                <input type="hidden" name="responsavel" value="{{ $vaga->responsavel ?? '' }}">
                                <div class="modal-footer centered">
                                    <button type="submit" class="btn btn-danger">Enviar dados</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal de Filtro -->
    <div class="modal" tabindex="-1" id="modalFiltro" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filtros</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="GET">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="filtro[]" value="Emprego" id="emprego" 
                                {{ in_array('Emprego', $checkbox ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="emprego">Emprego</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="filtro[]" value="Estagio" id="estagio"
                                {{ in_array('Estagio', $checkbox ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="estagio">Estágio</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="filtro[]" value="Aprendizagem" id="aprendizagem"
                                {{ in_array('Aprendizagem', $checkbox ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="aprendizagem">Aprendizagem</label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Filtrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de edição das vagas -->
    @foreach($vagas as $vaga)
        <div class="modal fade" id="modalEditarVaga-{{ $vaga->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background-color: #e9e9e9;">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Vaga: {{ $vaga->titulo }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('vaga.atualizar', $vaga->id) }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group mb-2 d-flex flex-column">
                                <label for="empresa-{{ $vaga->id }}">Empresa:</label>
                                <input name="empresa" id="empresa-{{ $vaga->id }}" type="text" class="form-control"
                                    value="{{ $vaga->empresa }}" required>
                            </div>

                            <div class="form-group mb-2 d-flex flex-column">
                                <label for="email-{{ $vaga->id }}">E-mail:</label>
                                <input name="email" id="email-{{ $vaga->id }}" type="email" class="form-control"
                                    value="{{ $vaga->email }}" required>
                            </div>

                            <div class="form-group mb-2 d-flex flex-column">
                                <label for="telefone-{{ $vaga->id }}">Telefone:</label>
                                <input name="telefone" id="telefone-{{ $vaga->id }}" type="tel" class="form-control"
                                    value="{{ $vaga->telefone }}" required>
                            </div>

                            <div class="form-group mb-2 d-flex flex-column">
                                <label for="responsavel-{{ $vaga->id }}">Responsável:</label>
                                <input name="responsavel" id="responsavel-{{ $vaga->id }}" type="text" class="form-control"
                                    value="{{ $vaga->responsavel }}" required>
                            </div>

                            <div class="form-group mb-2 d-flex flex-column">
                                <label for="titulo-{{ $vaga->id }}">Título da Vaga:</label>
                                <input name="titulo" id="titulo-{{ $vaga->id }}" type="text" class="form-control"
                                    value="{{ $vaga->titulo }}" required>
                            </div>

                            <div class="form-group mb-2 d-flex flex-column">
                                <label for="tipo-{{ $vaga->id }}">Tipo de Vaga:</label>
                                <select name="tipo" id="tipo-{{ $vaga->id }}" class="form-select" required>
                                    <option value="EMPREGO" {{ $vaga->tipo == 'EMPREGO' ? 'selected' : '' }}>Emprego</option>
                                    <option value="ESTAGIO" {{ $vaga->tipo == 'ESTAGIO' ? 'selected' : '' }}>Estágio</option>
                                    <option value="APRENDIZAGEM" {{ $vaga->tipo == 'APRENDIZAGEM' ? 'selected' : '' }}>Aprendizagem</option>
                                </select>
                            </div>

                            <div class="form-group mb-2 d-flex flex-column">
                                <label for="requisitos-{{ $vaga->id }}">Requisitos:</label>
                                <textarea name="requisitos" id="requisitos-{{ $vaga->id }}" class="form-control" rows="3" required>{{ $vaga->requisitos }}</textarea>
                            </div>

                            <div class="form-group mb-2 d-flex flex-column">
                                <label for="atividades-{{ $vaga->id }}">Atividades:</label>
                                <textarea name="atividades" id="atividades-{{ $vaga->id }}" class="form-control" rows="3" required>{{ $vaga->atividades }}</textarea>
                            </div>

                            <div class="form-group mb-2 d-flex flex-column">
                                <label for="init_expediente-{{ $vaga->id }}">Início do expediente:</label>
                                <input name="init_expediente" id="init_expediente-{{ $vaga->id }}" type="time" class="form-control"
                                    value="{{ $vaga->init_expediente }}" required>
                            </div>

                            <div class="form-group mb-2 d-flex flex-column">
                                <label for="fim_expediente-{{ $vaga->id }}">Fim do expediente:</label>
                                <input name="fim_expediente" id="fim_expediente-{{ $vaga->id }}" type="time" class="form-control"
                                    value="{{ $vaga->fim_expediente }}" required>
                            </div>

                            <div class="form-group mb-2 d-flex flex-column">
                                <label for="beneficios-{{ $vaga->id }}">Benefícios:</label>
                                <textarea name="beneficios" id="beneficios-{{ $vaga->id }}" class="form-control" rows="3" required>{{ $vaga->beneficios }}</textarea>
                            </div>

                            <div class="form-group mb-2 d-flex flex-column">
                                <label for="tipo-{{ $vaga->id }}">Visibilidade:</label>
                                <select name="visibilidade" id="tipo-{{ $vaga->id }}" class="form-select" required>
                                    <option value="0" {{ $vaga->visibilidade == 0 ? 'selected' : '' }}>Vaga não publicada</option>
                                    <option value="1" {{ $vaga->visibilidade == 1 ? 'selected' : '' }}>Vaga publicada</option>
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Salvar Alterações</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>

                            <input type="hidden" name="publicacao" id="data_hora_cliente_{{ $vaga->id }}">
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const input = document.getElementById('data_hora_cliente_{{ $vaga->id }}');
                                    if (!input) return;
                                    const now = new Date();
                                    const formatted = now.getFullYear() + '-' +
                                        String(now.getMonth() + 1).padStart(2,'0') + '-' +
                                        String(now.getDate()).padStart(2,'0') + ' ' +
                                        String(now.getHours()).padStart(2,'0') + ':' +
                                        String(now.getMinutes()).padStart(2,'0') + ':' +
                                        String(now.getSeconds()).padStart(2,'0');
                                    input.value = formatted;
                                });
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


@endsection