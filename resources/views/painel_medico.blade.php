@extends("layout.app")

@section("titulo", "Painel do Médico")

@section('context')
    <section class="page" id="doctorHomePage">
        <div class="user-welcome">
            <h2 class="section-title">Olá, Dr(a). {{ $medico['nome'] }}!</h2>
            <p class="user-subtitle">CRM: {{ $medico['crm'] }}</p>
        </div>

        <div class="menu-grid">
            <a class="menu-card" href="{{ route('page_consultas_medico') }}">
                <h3 class="menu-title">Painel de Consultas</h3>
                <p class="menu-description">Veja e gerencie as consultas dos pacientes</p>
            </a>

            <a class="menu-card" href="{{ route('logout') }}" onclick="return confirm('Tem certeza que deseja sair da conta?');">
                <h3 class="menu-title">Sair</h3>
                <p class="menu-description">Encerrar sessão</p>
            </a>
        </div>
    </section>
@endsection