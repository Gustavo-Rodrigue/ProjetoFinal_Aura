<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('title', 'Página Inicial')

@push('styles')

@endpush

@section('content')
<div class="d-none d-md-block" >
    <div class="ms-5 container d-flex flex-row mt-5 " style="height: 100vh;">
        <div class="d-flex">
            <div class="list-group"> <!-- Esconde em mobile -->
                <ul style="list-style: none;">
                    <a href="#" class="list-group-item list-group-item-action btn-init"><li>Home</li></a>
                    <a href="#" class="list-group-item list-group-item-action btn-init"><li>Institucional</li></a>
                    <a href="#" class="list-group-item list-group-item-action btn-init"><li>Informações ao alunos</li></a>
                    <a href="#" class="list-group-item list-group-item-action btn-init"><li>Horário de atendimento</li></a>
                    <a href="{{ route('mural.index') }}" class="list-group-item list-group-item-action btn-init"><li>Procurar vagas</li></a>
                </ul>
            </div>
            <div class="me-5" style="height: 30vh;"> <!-- Esconde em mobile -->
                <img src="{{ asset('img/escola.png') }}" alt="Imagem Senai">
            </div>
        </div>
        <div>
            <div class="d-flex flex-column">
                <hr>
                <ul class="d-flex gap-3" style="list-style: none;">
                    <li><i class="bi bi-instagram" style="color: #7b7b7bff;"></i></li>
                    <li><i class="bi bi-facebook" style="color: #7b7b7bff;"></i></li>
                </ul>
                <hr>
                <div>
                    <p style="color: #7b7b7bff;">SENAI Santo André</p>
                    <h1>Escola SENAI "A Jacob Lafer"</h1>
                    <button type="button" class="btn" style="color: #fff; background: linear-gradient(45deg, #8c050eff, #f34030ff); border:none; border-radius:30px;">CONHEÇA NOSSOS CURSOS</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Versão Mobile - Só a imagem -->
<div class="d-block d-md-none container mt-4">
    <div class="text-center">
        <img src="{{ asset('img/escola.png') }}" alt="Imagem Senai" class="img-fluid w-100 rounded shadow">
    </div>
   
    <!-- Bloco de cursos no mobile -->
    <div class="text-center mt-4 mb-5">

        <!-- Título e ícones -->
        <div class="d-flex justify-content-center align-items-center position-relative mb-2">
            <h3 class="fw-bold m-0">Cursos</h3>
        </div>

        <!-- Seta -->
        <i class="bi bi-chevron-down text-danger fs-1"></i>

        <!-- Lista de cursos -->
        <div class="mt-3 d-flex flex-column align-items-center gap-3">
            <div class="curso-card text-white fw-bold py-3 w-100" style="background-color:#E30613;">Pesquisar Todos</div>

            <div class="curso-card bg-white text-dark py-3 w-100 position-relative shadow-sm rounded">
                <span class="fw-semibold">Alimentos e Bebidas</span>
            </div>

            <div class="curso-card bg-white text-dark py-3 w-100 position-relative shadow-sm rounded">
                <span class="fw-semibold">Automotiva</span>
            </div>

            <div class="curso-card bg-white text-dark py-3 w-100 position-relative shadow-sm rounded">
                <span class="fw-semibold">Construção Civil e Design de Mobiliário</span>
            </div>
        </div>

    </div>
</div>

<style>
    .btn-init{
        background-color: #E30613; 
        color: #fff; 
        border:none;
    }

    .btn-init:hover {
        background-color: #c1040fff; 
        color: #fff; 
        border:none;
    }

    @media (max-width: 767.98px) {
        .ms-5.container {
            height: auto !important;
            margin-left: 0 !important;
            padding: 1rem;
        }
        
        .ms-5.container > .d-flex {
            flex-direction: column;
            width: 100%;
        }
        .curso-card {
            border-left: 4px solid #E30613;
            border-radius: 8px;
            padding-left: 3rem;
            padding-right: 3rem;
        }
        .curso-card:first-child {
            border-left: none;
            border-radius: 6px;
        }
    }
</style>
@endsection
