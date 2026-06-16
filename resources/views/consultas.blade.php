@extends("layout.app")

@section("titulo", "Página de Consultas")

@section('context')
    <section class="page" id="appointmentsPage">
        <button class="btn-back" onclick="history.back()">← Voltar</button>
        <h2 class="section-title">Minhas Consultas Marcadas</h2>

        <div class="appointments-list" id="appointmentsList">     
            @forelse($consultas as $consulta)
                
                {{-- Card da Consulta --}}
                <div class="appointment-item">
                    
                    {{-- Bloco de Informações (Data e Unidade) --}}
                    <div>
                        <p style="margin: 0 0 8px 0; font-size: 16px; color: #333;">
                            <strong>Data:</strong> {{ $consulta['data_formatada'] ?? 'Data não definida' }}
                        </p>
                        <p style="margin: 0; font-size: 14px; color: #666;">
                            <strong>Unidade:</strong> {{ $consulta['unidade'] ?? 'Não informada' }}
                        </p>
                    </div>

                    {{-- Bloco do Status e Botão Cancelar (um em cima do outro) --}}
                    <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                        <span style="background-color: {{ $consulta['cor_status'] ?? '#6c757d' }}; color: #ffffff; padding: 8px 16px; border-radius: 20px; font-weight: bold; font-size: 14px; display: inline-block;">
                            {{ $consulta['status'] ?? 'Agendado' }}
                        </span>
                        <a href="{{ route('consulta.cancelar', urlencode($consulta['dataHora'])) }}" class="option-item" onclick="return confirm('Tem certeza que deseja cancelar esta consulta?');">
                            <span class="option-text">Cancelar</span>
                        </a>
                                                                        
                    </div>

                </div>

            @empty
                {{-- Caso o array esteja vazio --}}
                <div class="empty-state">
                    <p class="empty-text">Você ainda não tem consultas marcadas</p>
                    <a class="btn btn-primary" href="{{ route("page_agendamento") }}">Agendar Atendimento</a>
                </div>
            @endforelse

        </div>
    </section>
@endsection