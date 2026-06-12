@extends("layout.app")

@section("titulo", "Página de Cadastro")

@section('context')
    <section class="page" id="registerPage">
        <button class="btn-back" onclick="history.back()">← Voltar</button>
        <div class="form-card">
            <h2 class="section-title">Novo Cadastro</h2>
            <form id="registerForm" class="form">
                <div class="form-group">
                    <label class="form-label" for="registerName">Nome Completo</label>
                    <input type="text" class="form-input" id="registerName" placeholder="Seu nome completo" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="registerCpf">CPF</label>
                    <input type="text" class="form-input" id="registerCpf" placeholder="000.000.000-00" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="registerEmail">Email</label>
                    <input type="email" class="form-input" id="registerEmail" placeholder="email@email.com" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="registerPassword">Senha</label>
                    <input type="password" class="form-input" id="registerPassword" placeholder="Crie uma senha" required>
                </div>
                <button type="button" class="btn btn-primary btn-large" id="btnCadastrar">Cadastrar</button>
            </form>
        </div>
    </section>

    <script>
    async function CadastrarUsuario () {
        let nomeInput = document.querySelector("input#registerName").value;
        let cpfInput = document.querySelector("input#registerCpf").value;
        let emailInput = document.querySelector("input#registerEmail").value;
        let senhaInput = document.querySelector("input#registerPassword").value;

        const dadosCadastrados = {
            nome: nomeInput,
            cpf: cpfInput,
            email: emailInput,
            senha: senhaInput
        }
        
        try {
            const resposta = await fetch ("{{ route('novo_cadastro')}}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(dadosCadastrados)
            });

            const resultado = await resposta.json();
            console.log("Server response: ", resultado)
            if (resultado.status === 201) {
                alert(resultado.mensagem); 
                window.location.href = "{{ url('/') }}" // Redirecionamento de páginas
            } else {
                alert(resultado.mensagem); 
                
            }
        } catch (error) {
            alert( "houve um erro em nosso servidor... ");
                        
        }
    }
    let btnCadastro = document.querySelector("button#btnCadastrar");
    btnCadastro.addEventListener("click", CadastrarUsuario);
    </script>
@endsection