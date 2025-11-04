<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('title', 'Página Inicial')

@push('styles')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #d4d4d4ff;
        margin: 0;
        padding: 0;
    }

    /* CONTAINER PRINCIPAL */
    .sec1 {
        font-size: 1rem;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 40px auto;
        padding: 20px;
    }

    h1, h2, h5 {
        font-weight: bold;
    }

    .par_2{
      text-align: justify;
    }

    .titulo {
        text-align: center;
    }

    /* ---------- MENU SUPERIOR ---------- */
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

    .menu-links li {
        color: #000;
        font-weight: bold;
    }

    .menu-links li a {
        color: #000;
        text-decoration: none;
    }

    /* Mantém as barras “|” na horizontal */
    .menu-links li.separator {
        font-weight: bold;
    }

    /* ---------- MODAL ---------- */
    #vagaModal .modal-dialog {
        max-width: 720px;
        margin: 1.5rem auto;
    }

    #vagaModal .modal-content {
        border-radius: 14px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        overflow: hidden;
    }

    #vagaModal .modal-header {
        padding-top: 18px;
        padding-bottom: 8px;
    }

    #vagaModal .modal-title {
        font-size: 1.6rem;
        font-weight: 800;
        color: #111827;
    }

    #vagaModal .btn-close {
        background: transparent;
        border: none;
        width: auto;
        height: auto;
        padding: 0.25rem 0.5rem;
    }

    #vagaModal .btn-close::after {
        content: "✕";
        font-size: 1.6rem;
        color: #000;
        font-weight: 700;
    }

    #vagaModal .form-control,
    #vagaModal textarea.form-control {
        background: #efefef;
        border: 1px solid #bfbfbf;
        border-radius: 10px;
        padding: 10px 14px;
        box-shadow: none;
    }

    #vagaModal label {
        font-weight: 700;
        font-size: 0.85rem;
        margin-bottom: 6px;
        display: block;
    }

    #vagaModal .modal-body {
        padding: 1rem 2rem 1.5rem 2rem;
    }

    #vagaModal .modal-footer {
        border-top: none;
        padding: 1rem 2rem 2rem 2rem;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    #vagaModal .modal-footer .btn-success {
        background: #ff0000 !important;
        border: none !important;
        width: 220px;
        border-radius: 8px !important;
        font-weight: bold;
    }

    #vagaModal .btn-secondary {
        border-radius: 8px;
        background: #6c757d;
        color: white;
    }

    /* ---------- RESPONSIVIDADE ---------- */
    @media (max-width: 768px) {
        body {
            background-color: #d4d4d4;
        }

        .sec1 {
            margin: 20px auto;
            padding: 20px;
            width: 90%;
        }

        .menu-links {
            flex-direction: column;
            align-items: flex-start; /* já alinha à esquerda */
            margin: 0 10px;
            gap: 8px; /* um pouco mais de espaço entre itens */
            font-size: 0.95rem;
            padding-left: 0; /* remove o padding lateral */
        }

        /* Separador mais grosso usando borda inferior */
        .menu-links li a {
            display: block;
            padding-bottom: 6px;
            border-bottom: 1.5px solid #000000ff; /* aumenta a espessura da linha */
            width: 100%;
        }

        /* Esconder o antigo separador | */
        .menu-links li.separator {
            display: none;
        }
        
        .sec2 h1, .sec2 h2 {
            font-size: 1.3rem;
        }

        .par_2 {
            text-align: justify;
            padding: 0px 30px !important;
            font-size: 0.95rem;
        }

        .container button {
            width: 100% !important;
            height: 45px !important;
            margin: 15px auto;
        }

        #vagaModal .modal-dialog {
            max-width: 92%;
        }

        #vagaModal .modal-title {
            font-size: 1.2rem;
        }

        #vagaModal .modal-footer .btn-success {
            width: 100%;
        }
        .btn{
          margin-left: 0 !important;
        }
    }

    /* Forçar títulos do header/layout em negrito (aplica-se ao layout caso exista navbar) */
    .navbar .navbar-brand,
    .navbar .nav-link,
    header h1,
    header .titulo,
    .menu-links li a {
        font-weight: 700 !important;
    }
</style>
@endpush

@section('content')
<div class="sec1 container mt-4">
    <!-- MENU -->
    <div class="estagio">
        <ul class="menu-links">
            <li><a href="{{ route('informacoes.index') }}">Informações</a></li>
            <li class="separator">|</li>
            <li><a href="{{ route('mural.index') }}">Mural de oportunidades</a></li>
            <li class="separator">|</li>
            <li><a href="{{ route('documento_estagio.index') }}">Documentos de Estágio</a></li>
        </ul>
    </div>

    <hr>

    <!-- TÍTULO -->
    <div class="sec2 text-center d-flex flex-column justify-content-center">
        <h1>Estágio/Emprego</h1>
        <br>
    </div>

    <!-- SEÇÃO 2 -->
    <div class="par_2" style="padding: 30px;">
        <h5 class="align-items-center d-flex">Atenção, alunos e ex-alunos!</h5>
        <p><br>Se você está em busca de uma oportunidade no mercado de trabalho — seja estágio, vaga efetiva ou aprendizagem — nossa escola disponibiliza o Mural de Oportunidades, onde divulgamos as vagas encaminhadas por empresas parceiras.<br><br>
        Fique à vontade para consultar o mural sempre que quiser! E, caso tenha dúvidas ou precise de orientação, entre em contato com nosso Orientador de Estágios, professor Thales Trocoletto, que está à disposição para ajudar.</p>
    </div>

    <!-- SEÇÃO 3 -->
    <div class="sec2 text-center d-flex flex-column justify-content-center">
        <h2 style="font-size:30px;">Orientação de Estágios <br> Profº Tales Trocoletto</h2>
        <p>Email:<a href="mailto:estagio118@sp.senai.br" style="color:#ff0000;"> estagio118@sp.senai.br</a></p>
        <hr>
    </div>

    <!-- SEÇÃO 4 -->
    <div class="par_2" style="padding: 30px;">
        <h1 class="text-center d-flex flex-column justify-content-center mb-1">Cadastro de Vagas - Empresas</h1>
        <br>
        <p>Convidamos as empresas que desejarem divulgar oportunidades de estágio, emprego efetivo ou aprendizagem a preencherem o formulário clicando no botão abaixo.<br>
        A participação das empresas é super importante para o desenvolvimento profissional dos estudantes dos cursos SENAI-SP.</p>
    </div>

        <!-- 2 Part -->
        <div class="par_2" style="padding: 30px;">
            <h5 class="align-items-center d-flex">Atenção, alunos e ex-alunos!</h5>
            <p><br>Se você está em busca de uma oportunidade no mercado de trabalho — seja estágio, vaga efetiva ou aprendizagem — nossa escola disponibiliza o Mural de Oportunidades, onde divulgamos as vagas encaminhadas por empresas parceiras.<br> <br>
            Fique à vontade para consultar o mural sempre que quiser! E, caso tenha dúvidas ou precise de orientação, entre em contato com nosso Orientador de Estágios, professor Thales Trocoletto, que está à disposição para ajudar.</p>
        </div>

        <!-- 3 Part -->
         <div class="sec2 text-center d-flex flex-column justify-content-center">
            <h2 style="font-weight: bold; font-size:30px;">Orientação de Estágios <br> Profº Tales Trocoletto</h2>
            <p>Email:<a href=""  style="color:#ff0000;"> estagio118@sp.senai.br</a></p>
            <hr>

        </div>

        <!-- 4 part -->
         <div class="par_2" style="padding: 30px;">
            <h1 class="text-center d-flex flex-column justify-content-center mb-1">Cadastro de Vagas - Empresas</h1>
            <?php $mensagem = ''; ?>
            @if(session('mensagem'))
              <div class="alert {{ session('tipo') }}">
                {{ session('mensagem') }}
              </div>
            @endif

            <!-- Erros de validação -->
            @if($errors->any())
              @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
              @endforeach
            @endif
            <br>
            <p><br>Convidamos as empresas que desejarem divulgar oportunidades de estágio, emprego efetivo ou aprendizagem a preencherem o formulário clicando no botão abaixo:<br>A participação das empresas é super importante para o desenvovimento profissional de todos os estudantes dos cursos SENAI-SP.</p>
        </div>

        <!-- Botão para abrir o modal -->
      <div class="container text-center">
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#vagaModal" style="background-color: #ff0000; color: white; font-weight: bold; height: 35px; width: 300px; border-radius: 8px; margin:20px;">
         Cadastrar Vaga
        </button>
      </div>

    <!-- MODAL -->
    <div class="modal fade" id="vagaModal" tabindex="-1" aria-labelledby="vagaModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg"> <!-- modal-lg para maior espaço -->
        <div class="modal-content">
          <div class="modal-header position-relative">
            <button type="button" class="btn-close position-absolute end-0 top-50 translate-middle-y" data-bs-dismiss="modal" aria-label="Fechar"></button>
            <h5 class="modal-title titulo mx-auto text-center" id="vagaModalLabel">Adicionar Nova Vaga</h5>
          </div>
          <div class="modal-body">
            <form action="{{ route('vaga') }}" method="POST">
              @csrf
              <!-- Nome da Empresa -->
              <div class="mb-3">
                <label for="empresa" class="form-label">Nome da Empresa</label>
                <input type="text" name="empresa" class="form-control" id="empresa" required>
              </div>

              <!-- E-mail para contato -->
              <div class="mb-3">
                <label for="email" class="form-label">E-mail para Contato</label>
                <input type="email" name="email" class="form-control" id="email" required>
              </div>

              <!-- Telefone para contato -->
              <div class="mb-3">
                <label for="telefone" class="form-label">Telefone para Contato</label>
                <input type="tel" name="telefone" class="form-control" id="telefone" required>
              </div>

              <!-- Nome do Responsável -->
              <div class="mb-3">
                <label for="responsavel" class="form-label">Nome do Responsável</label>
                <input type="text" name="responsavel" class="form-control" id="responsavel" required>
              </div>

              <!-- Título da Vaga -->
              <div class="mb-3">
                <label for="tituloVaga" class="form-label">Título da Vaga</label>
                <input type="text" name="titulo" class="form-control" id="tituloVaga" required>
              </div>

              <!-- Tipo de Vaga -->
              <div class="mb-3">
                <label for="tipoVaga" class="form-label">Tipo de Vaga</label>
                <select class="form-select" name="tipo" id="tipoVaga" required>
                  <option value="">Selecione...</option>
                  <option value="EMPREGO">Emprego</option>
                  <option value="ESTAGIO">Estágio</option>
                  <option value="APRENDIZAGEM">Aprendizagem</option>
                </select>
              </div>

              <!-- Requisitos -->
              <div class="mb-3">
                <label for="requisitos" class="form-label">Requisitos</label>
                <textarea name="requisitos" class="form-control" id="requisitos" rows="3" required></textarea>
              </div>

              <!-- Atividades -->
              <div class="mb-3">
                <label for="atividades" class="form-label">Atividades</label>
                <textarea name="atividades" class="form-control" id="atividades" rows="3" required></textarea>
              </div>

              <!-- Expediente -->
              <div class="mb-3">
                <label for="horario" class="form-label">Inicio do expediente</label>
                <input name="init_expediente" type="text" class="form-control" id="init_expediente" placeholder="ex.06:00:00" required>
              </div>

              <div class="mb-3">
                <label for="horario" class="form-label">Fim do expediente</label>
                <input name="fim_expediente" type="text" class="form-control" id="fim_expediente" placeholder="ex.14:00:00" required>
              </div>

              <!-- Benefícios (incluindo salário) -->
              <div class="mb-3">
                <label for="beneficios" class="form-label">Benefícios (incluir salário se desejar)</label>
                <textarea name="beneficios" class="form-control" id="beneficios" rows="3" required></textarea>
              </div>

              <!-- No formulário do modal, ajustar o input hidden -->
              <input type="hidden" name="publicacao" id="data_hora_cliente">

              <!-- visibilidade -->
              <input type="hidden" name="visibilidade" id="visibilidade" value="0">


              <!-- Botões -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Enviar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    </div>
    <!-- Corrigir o script para preencher o campo -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
          const input = document.getElementById('data_hora_cliente'); // usa o mesmo id do input
          if (!input) return; // verifica se encontrou o elemento
          
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




@endsection



