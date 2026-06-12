@extends("layout.app")

@section("titulo", "Página de Agendamento")

@section('context')
    <section class="page" id="schedulingPage">
        <button class="btn-back" onclick="history.back()">← Voltar</button>
        <h2 class="section-title">Agendar Atendimento</h2>
        <div class="form-card">
            <form id="schedulingForm" class="form">
                <div class="form-group">
                    <label class="form-label-large" for="serviceType">Tipo de Atendimento</label>
                    <select class="form-select" id="tipoConsulta" required>
                        <option value="">Selecione o serviço</option>
                        <option value="consulta">Consulta Médica</option>
                        <option value="exame">Exames</option>
                        <option value="vacina">Vacinação</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label-large" for="appointmentDate">Data</label>
                    <input type="date" class="form-input" id="dataAgendada" required>
                </div>
                <div class="form-group">
                    <label class="form-label-large" for="appointmentTime">Horário</label>
                    <select class="form-select" id="horaAtendimento" required>
                        <option value="">Selecione o horário</option>
                        <option value="08:00">08:00</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label-large" for="healthUnit">Unidade de Saúde</label>
                    <select class="form-select" id="unidade" required>
                        <option value="">Selecione a unidade</option>
                        <option value="UBS Centro Itapiuva">UBS Centro Itapiuva</option>
                        <option value="UBS Jardim das Flores">UBS Jardim das Flores</option>
                        <option value="UBS Vasconcellos">UBS Vasconcellos</option>
                        <option value="Hospital Municipal">Hospital Municipal</option>
                    </select>
                </div>
                <button type="button" class="btn btn-primary btn-xlarge" id="btnAgendarConsulta">Confirmar Agendamento</button>
            </form>
        </div>
    </section>/

    <script>
        async function AgendamentoUsuario () {

        let tipoAtendimentoInput = document.querySelector("#tipoConsulta").value;
        let dataAgendadaInput = document.querySelector("#dataAgendada").value;
        let horaAtendimentoInput = document.querySelector("#horaAtendimento").value;
        let unidadeInput = document.querySelector("#unidade").value;

        

        let dataHoraInput = dataAgendadaInput + " " + horaAtendimentoInput;

        const dadosAgendamento = {
            tipoConsulta: tipoAtendimentoInput,
            dataHora: dataHoraInput,
            unidade: unidadeInput
        }

        try {
            const resposta = await fetch ("{{ route('novo_agendamento')}}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(dadosAgendamento)
            });

            const resultado = await resposta.json()
            if (resultado.status == 201) {
                alert(resultado.mensagem);
                window.location.href = "{{route('painel_usuario')}}"
            } else {
                alert(resultado.mensagem);
            }
        } catch (error) {
            alert("houve um erro em nosso servidor... ");        
        }
    }
    const btnAgendarConsulta = document.querySelector("button#btnAgendarConsulta");
    btnAgendarConsulta.addEventListener("click", AgendamentoUsuario);
    </script>

@endsection
