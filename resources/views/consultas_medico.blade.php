@extends("layout.app")

@section("titulo", "Painel de Consultas")

@section('context')
    <section class="page" id="doctorAppointmentsPage">
        <button class="btn-back" onclick="history.back()">← Voltar</button>
        <h2 class="section-title">Todas as Consultas</h2>

        <div class="appointments-list" id="appointmentsList">

            @forelse($consultas as $consulta)

                <div class="appointment-item">

                    <div>
                        <p style="margin: 0 0 8px 0; font-size: 16px; color: #333;">
                            <strong>Paciente:</strong> {{ $consulta['nome'] ?? 'Não informado' }}
                        </p>
                        <p style="margin: 0 0 8px 0; font-size: 14px; color: #666;">
                            <strong>CPF:</strong> {{ $consulta['cpf'] ?? '-' }}
                        </p>
                        <p style="margin: 0 0 8px 0; font-size: 14px; color: #666;">
                            <strong>Data:</strong> {{ $consulta['dataHora'] ?? 'Não definida' }}
                        </p>
                        <p style="margin: 0; font-size: 14px; color: #666;">
                            <strong>Unidade:</strong> {{ $consulta['unidade'] ?? 'Não informada' }}
                        </p>
                    </div>

                    <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                        <span style="background-color: {{ $consulta['cor_status'] ?? '#6c757d' }}; color: #ffffff; padding: 8px 16px; border-radius: 20px; font-weight: bold; font-size: 14px; display: inline-block;">
                            {{ $consulta['status'] ?? 'Agendado' }}
                        </span>

                        <a href="{{ route('consulta_finalizar', [urlencode($consulta['cpf']), urlencode($consulta['dataHora'])]) }}"
                           class="option-item"
                           onclick="return confirm('Marcar este atendimento como finalizado?');">
                            <span class="option-text">Processo Finalizado</span>
                        </a>

                        <a href="{{ route('consulta_ausencia', [urlencode($consulta['cpf']), urlencode($consulta['dataHora'])]) }}"
                           class="option-item"
                           onclick="return confirm('Registrar ausência do paciente?');">
                            <span class="option-text">Registrar Ausência</span>
                        </a>
                    </div>

                </div>

            @empty
                <div class="empty-state">
                    <p class="empty-text">Nenhuma consulta registrada no sistema.</p>
                </div>
            @endforelse

        </div>
    </section>
@endsection