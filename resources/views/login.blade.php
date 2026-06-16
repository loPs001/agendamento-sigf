@extends("layout.app")

@section("titulo", "Página de Login")

@section('context')
    <section class="page" id="loginPage">
        <button class="btn-back" onclick="history.back()">← Voltar</button>
        <div class="form-card">
            <h2 class="section-title">Entrar no Sistema</h2>
            <form id="loginForm" class="form">
                <div class="form-group">
                    <label class="form-label" for="loginCpf">CPF</label>
                    <input type="text" class="form-input" id="loginCpf" placeholder="000.000.000-00" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="loginPassword">Senha</label>
                    <input type="password" class="form-input" id="loginPassword" placeholder="Digite sua senha" required>
                </div>
                <button type="button" class="btn btn-primary btn-large" id="btnEntrar">Entrar</button>
            </form>
        </div>
    </section>
    
    <script>
        async function LoginDoUsuario () {
            let cpfInput = document.querySelector("input#loginCpf").value;
            let senhaInput = document.querySelector("input#loginPassword").value;
            
            const dadosLogin = {
                cpf: cpfInput,
                senha: senhaInput
            }
            try {
                const resposta = await fetch ("{{ route('novo_login') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(dadosLogin)
                });

                const resultado = await resposta.json();
                // console.log("Server Response:", resultado);
                if (resultado.status === 200) {
                    if (resultado.tipo === "medico") {
                        window.location.href = "{{ route('painel_medico') }}";
                    } else {
                        window.location.href = "{{ route('painel_usuario') }}";
                    }
                } else {
                    alert(resultado.mensagem);
                }
            } catch (error) {
                alert( "houve um erro em nosso servidor... ");
                            
            }
        }
        let btnEntrar = document.querySelector("button#btnEntrar");
        btnEntrar.addEventListener("click", LoginDoUsuario);
    </script>
@endsection