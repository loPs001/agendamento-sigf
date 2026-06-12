{{-- resources/views/painel.blade.php --}}
@extends("layout.app")

@section("titulo", "Painel do Usuário")

@section('context')
    <section class="page" id="userHomePage">
        <div class="user-welcome">
            <h2 class="section-title">Olá, <span id="displayUserName">{{ $usuario['nome'] }}</span>!</h2>
            <p class="user-subtitle">O que você deseja fazer hoje?</p>
        </div>

        <div class="menu-grid">
            <a class="menu-card" href="{{route("page_agendamento")}}">
                <h3 class="menu-title">Agendar Atendimento</h3>
                <p class="menu-description">Marque uma consulta ou exame</p>
            </a>

            <a class="menu-card" href="{{route("page_consultas")}}">
                <h3 class="menu-title">Consultas Marcadas</h3>
                <p class="menu-description">Veja seus agendamentos</p>
            </a>

            <a class="menu-card" href="{{route("page_opcoes")}}">
                <h3 class="menu-title">Opções de Usuário</h3>
                <p class="menu-description">Configurações da conta</p>
            </a>
        </div>
    </section>
@endsection