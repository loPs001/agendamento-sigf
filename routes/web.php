<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerAuth;
use App\Http\Controllers\ControllerUser;
use App\Http\Controllers\ControllerMedico;

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get("/page-cadastro", function () {
    return view("cadastro");
})->name("page_cadastro");
Route::post("/fazer-cadastro", [ControllerAuth::class, "Cadastro"])->name("novo_cadastro");

Route::get("/page-login", function () {
    return view("login");
})->name("page_login");
Route::post("/fazer-login", [ControllerAuth::class, "Login"])->name("novo_login");

Route::get('/logout', [ControllerUser::class, 'Logout'])->name('logout');

// Rotas do usuário
Route::middleware('verificado')->group(function () {
    Route::get("/painel", [ControllerUser::class, "ExibirHomeUser"])->name("painel_usuario");
    Route::get("/page-agendamento", function () {
        return view("agendamento");
    })->name("page_agendamento");
    Route::post("/fazer-agendamento", [ControllerUser::class, "CadastrarConsulta"])->name("novo_agendamento");
    Route::get('/consultas/cancelar/{dataHora}', [ControllerUser::class, 'CancelarConsulta'])->name('consulta_cancelar');
    Route::get("/page-consultas", [ControllerUser::class, "ExibirConsultasUser"])->name("page_consultas");
    Route::get("/page-opcoes", [ControllerUser::class, "ExibirOpcoesUser"])->name("page_opcoes");
});

// Rotas do médico
Route::middleware('medico')->group(function () {
    Route::get('/painel-medico', [ControllerMedico::class, 'ExibirPainelMedico'])->name('painel_medico');
    Route::get('/consultas-medico', [ControllerMedico::class, 'ExibirConsultasMedico'])->name('page_consultas_medico');
    Route::get('/consultas-medico/finalizar/{cpf}/{dataHora}', [ControllerMedico::class, 'FinalizarConsulta'])->name('consulta_finalizar');
    Route::get('/consultas-medico/ausencia/{cpf}/{dataHora}', [ControllerMedico::class, 'RegistrarAusencia'])->name('consulta_ausencia');
});