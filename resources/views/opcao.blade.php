@extends("layout.app");

@section("titulo", "Vizualizar Consultas")

@section('context')
    <section class="page" id="userOptionsPage">
        <button class="btn-back" onclick="history.back()">← Voltar</button>
        <h2 class="section-title">Opções de Usuário</h2><
        <div class="options-card">
            <div class="user-info">
                <h3 class="info-title">Informações da Conta</h3>
                <p class="info-text"><strong>Nome:</strong> {{$usuario["nome"]}} {{--<<span id="userInfoName">-</span>--}}</p>
                 <p class="info-text"><strong>CPF:</strong> {{$usuario["cpf"]}} {{--<span id="userInfoCpf">-</span> --}}</p>
            </div>

            <div class="options-list">
                <a href="{{ route('logout') }}" class="option-item" onclick="return confirm('Tem certeza que deseja sair da conta?');">
                    <span class="option-text">Sair da Conta</span>
                </a>
            </div>
        </div>
    </section>
@endsection

