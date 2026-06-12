<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerAuth;
use App\Http\Controllers\ControllerUser;

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

// Rotas protegidas - exigem login
Route::middleware('verificado')->group(function () {
    Route::get("/painel", [ControllerUser::class, "ExibirHomeUser"])->name("painel_usuario");

    Route::get("/page-agendamento", function () {
        return view("agendamento");
    })->name("page_agendamento");
    Route::post("/fazer-agendamento", [ControllerUser::class, "CadastrarConsulta"])->name("novo_agendamento");

    Route::get('/consultas/cancelar/{dataHora}', [ControllerUser::class, 'CancelarConsulta'])->name('consulta.cancelar');
    Route::get("/page-consultas", [ControllerUser::class, "ExibirConsultasUser"])->name("page_consultas");

    Route::get("/page-opcoes", [ControllerUser::class, "ExibirOpcoesUser"])->name("page_opcoes");
    Route::get('/logout', [ControllerUser::class, 'Logout'])->name('logout');
});