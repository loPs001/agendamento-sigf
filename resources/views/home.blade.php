@extends("layout.app")

@section('titulo', "Página Incial")

@section('context')
    <section class="page active" id="homePage">
        <div class="welcome-card">  
            <h2 class="section-title">Bem-vindo ao SUS Digital</h2>
            <p class="welcome-text">Agende consultas e acompanhe sua posição na fila de atendimento</p>
            <div class="button-group">
                <a href="{{ route("page_login")}}"  class="btn btn-primary"  data-page="login">Entrar</a>
                <a href="{{ route("page_cadastro")}}" class="btn btn-secondary" data-page="register">Cadastrar</a>
            </div>
        </div>
    </section>   

@endsection