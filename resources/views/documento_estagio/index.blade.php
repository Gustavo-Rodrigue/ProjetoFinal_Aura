@extends('layouts.app')

@section('title', 'Página Inicial')

@push('styles')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #d4d4d4;
        margin: 0;
        padding: 0;
    }

    /* CONTAINER PRINCIPAL */
    .container-custom {
        background-color: #ffffff;
        border-radius: 15px;
        padding: 20px;
        margin: 20px auto;
    }

    /* MENU */
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

    h1, h2, h5, p {
        margin: 0 0 15px 0;
    }

    p {
        text-align: justify;
    }

    a {
        color: #ff0000;
        text-decoration: underline;
    }

    h1{
        font-weight: bold;
    }

    /* ---------- RESPONSIVIDADE ---------- */
    @media (max-width: 770px) {
        .container-custom {
            width: 90%;
            padding: 15px;
        }

        .menu-links {
            flex-direction: column;
            align-items: flex-start; /* Alinha à esquerda */
            gap: 8px;
            margin: 0px 10px;
            padding-left: 0;
            padding-top: 15px;
        }

        /* Links com borda inferior mais grossa */
        .menu-links li a {
            display: block;
            padding-bottom: 6px;
            border-bottom: 1.5px solid #000;
            width: 100%;
            
        }

        /* Esconder separador antigo */
        .menu-links li.separator {
            display: none;
        }

        h1 {
            font-size: 1.5rem;
        }

        h2 {
            font-size: 1.3rem;
        }

        p {
            font-size: 0.95rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container-custom container mt-4">
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
    <div class="d-flex flex-column justify-content-center text-center">
        <h1>Documentos de Estágio</h1>
    </div>

    <!-- DOCUMENTOS -->
    <div class="d-flex flex-column gap-3 mt-4">
        <div class="ms-3">
            <h2>Documentos de Estágio para alunos dos Cursos Técnicos</h2>
            <p>Acesse o <a href="https://cronos-media.sesisenaisp.org.br/api/media/1-0/files?file=arq_153_240821_0d8be49d-94e4-41be-8a98-083852d15dc8.pdf&disposition=false" target="_blank">Regulamento de Estágio (Cursos Técnicos)</a></p>
            <p>Acesse o <a href="https://cronos-media.sesisenaisp.org.br/api/media/1-0/files?file=arq_153_240612_a7c7341e-e6bc-4dae-b78e-a03ac8e088f0.docx" target="_blank">Termo de Compromisso de Estágio Curso Técnico - Aluno Maior</a></p>
            <p>Acesse o <a href="https://cronos-media.sesisenaisp.org.br/api/media/1-0/files?file=arq_153_240612_120333a5-2231-444c-aa9c-d42bf5fcb918.docx" target="_blank">Termo de Compromisso de Estágio Curso Técnico - Aluno Menor</a></p>
            <p>Acesse o <a href="https://cronos-media.sesisenaisp.org.br/api/media/1-0/files?file=arq_153_240614_bfa514cc-6609-458b-b56f-d948f8624c81.docx" target="_blank">Termo de Compromisso de Estágio com agente integração - Aluno Maior</a></p>
            <p>Acesse o <a href="https://cronos-media.sesisenaisp.org.br/api/media/1-0/files?file=arq_153_240614_2a8bdffc-0669-4402-b74e-cb9d593a3267.docx" target="_blank">Termo de Compromisso de Estágio com agente integração - Aluno Menor</a></p>
            <p>Acesse o <a href="https://cronos-media.sesisenaisp.org.br/api/media/1-0/files?file=arq_153_250417_530fbc66-c7fe-4a70-aed7-026534351c6d.docx" target="_blank">Termo Aditivo de TCE - Aluno Menor</a></p>
            <p>Acesse o <a href="https://cronos-media.sesisenaisp.org.br/api/media/1-0/files?file=arq_153_250417_b8b80554-c5d5-422c-b0d1-a8a2a4478ba3.docx" target="_blank">Termo Aditivo de TCE - Aluno Maior</a></p>
        </div>
    </div>
    <hr>
</div>
@endsection
