<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AplicationController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ContasController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\MovimentoController;
use App\Http\Controllers\MovimentoGastoController;
use App\Http\Controllers\MovimentoRendaController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\TipoController;

// Rotas de Administração de dados da conta

Route::prefix('conta')->middleware('auth')->group(function () {
    Route::controller(ContasController::class)->group(function () {
        Route::group(['middleware' => ['permission:read conta']], function () {
            Route::get('/', 'index')->name('indexConta');
            Route::get('/show/{id}', 'show')->name('showConta');
        });
        Route::group(['middleware' => ['permission:create conta']], function () {
            Route::get('/create', 'create')->name('createConta');
            Route::post('/store', 'store')->name('storeConta');
        });
        Route::group(['middleware' => ['permission:edit conta']], function () {
            Route::get('/edit/{id}', 'edit')->name('editConta');
            Route::post('/update/{id}', 'update')->name('updateConta');
        });
        Route::group(['middleware' => ['permission:delete conta']], function () {
            Route::delete('/{id}', 'destroy')->name('deleteConta');
        });
    });
});

// Rotas de Grupos

Route::prefix('grupo')->middleware('auth')->group(function () {
    Route::controller(GrupoController::class)->group(function () {
        Route::group(['middleware' => ['permission:read grupo']], function () {
            Route::get('/', 'index')->name('indexGrupo');
            Route::get('/show/{id}', 'show')->name('showGrupo');
        });

        Route::group(['middleware' => ['permission:create grupo']], function () {
            Route::get('/create', 'create')->name('createGrupo');
            Route::post('/store', 'store')->name('storeGrupo');
        });
        Route::group(['middleware' => ['permission:edit grupo']], function () {
            Route::get('/edit/{id}', 'edit')->name('editGrupo');
            Route::post('/update/{id}', 'update')->name('updateGrupo');
        });
        Route::group(['middleware' => ['permission:delete grupo']], function () {
            Route::delete('/{id}', 'destroy')->name('deleteGrupo');
        });
    });
});

// Rotas de tipos

Route::prefix('tipo')->middleware('auth')->group(function () {
    Route::controller(TipoController::class)->group(function () {
        Route::group(['middleware' => ['permission:read tipo']], function () {
            Route::get('/', 'index')->name('indexTipo');
            Route::get('/show/{id}', 'show')->name('showTipo');
        });

        Route::group(['middleware' => ['permission:create tipo']], function () {
            Route::get('/create', 'create')->name('createTipo');
            Route::post('/store', 'store')->name('storeTipo');
        });
        Route::group(['middleware' => ['permission:edit tipo']], function () {
            Route::get('/edit/{id}', 'edit')->name('editTipo');
            Route::post('/update/{id}', 'update')->name('updateTipo');
        });
        Route::group(['middleware' => ['permission:delete tipo']], function () {
            Route::delete('/{id}', 'destroy')->name('deleteTipo');
        });
    });
});

// Rotas de movimentos

Route::prefix('movimento')->middleware('auth')->group(function () {
    Route::controller(MovimentoController::class)->group(function () {
        Route::group(['middleware' => ['permission:read movimento']], function () {
            Route::get('/', 'index')->name('indexMovimento');
            Route::get('/show/{id}', 'show')->name('showMovimento');
        });

        Route::group(['middleware' => ['permission:create movimento']], function () {
            Route::get('/create', 'create')->name('createMovimento');
            Route::post('/store', 'store')->name('storeMovimento');
        });
        Route::group(['middleware' => ['permission:edit movimento']], function () {
            Route::get('/edit/{id}', 'edit')->name('editMovimento');
            Route::post('/update/{id}', 'update')->name('updateMovimento');
        });
        Route::group(['middleware' => ['permission:delete movimento']], function () {
            Route::delete('/{id}', 'destroy')->name('deleteMovimento');
        });
    });
});

// Rotas de movimentos Renda

Route::prefix('movimento_renda')->middleware('auth')->group(function () {
    Route::controller(MovimentoRendaController::class)->group(function () {
        Route::group(['middleware' => ['permission:read movimento']], function () {
            Route::get('/', 'index')->name('indexMovimentoRenda');
            Route::get('/show/{id}', 'show')->name('showMovimentoRenda');
        });

        Route::group(['middleware' => ['permission:create movimento']], function () {
            Route::get('/create', 'create')->name('createMovimentoRenda');
            Route::post('/store', 'store')->name('storeMovimentoRenda');
        });
        Route::group(['middleware' => ['permission:edit movimento']], function () {
            Route::get('/edit/{id}', 'edit')->name('editMovimentoRenda');
            Route::post('/update/{id}', 'update')->name('updateMovimentoRenda');
        });
        Route::group(['middleware' => ['permission:delete movimento']], function () {
            Route::delete('/{id}', 'destroy')->name('deleteMovimentoRenda');
        });
    });
});

// Rotas de movimentos Gastos

Route::prefix('movimento_gastos')->middleware('auth')->group(function () {
    Route::controller(MovimentoGastoController::class)->group(function () {
        Route::group(['middleware' => ['permission:read movimento']], function () {
            Route::get('/', 'index')->name('indexMovimentoGasto');
            Route::get('/show/{id}', 'show')->name('showMovimentoGasto');
        });

        Route::group(['middleware' => ['permission:create movimento']], function () {
            Route::get('/create', 'create')->name('createMovimentoGasto');
            Route::post('/store', 'store')->name('storeMovimentoGasto');
        });
        Route::group(['middleware' => ['permission:edit movimento']], function () {
            Route::get('/edit/{id}', 'edit')->name('editMovimentoGasto');
            Route::post('/update/{id}', 'update')->name('updateMovimentoGasto');
        });
        Route::group(['middleware' => ['permission:delete movimento']], function () {
            Route::delete('/{id}', 'destroy')->name('deleteMovimentoGasto');
        });
    });
});

// Rotas de categorias

Route::prefix('categoria')->middleware('auth')->group(function () {
    Route::controller(CategoriaController::class)->group(function () {
        Route::group(['middleware' => ['permission:read categoria']], function () {
            Route::get('/', 'index')->name('indexCategoria');
            Route::get('/show/{id}', 'show')->name('showCategoria');
        });

        Route::group(['middleware' => ['permission:create categoria']], function () {
            Route::get('/create', 'create')->name('createCategoria');
            Route::post('/store', 'store')->name('storeCategoria');
        });
        Route::group(['middleware' => ['permission:edit categoria']], function () {
            Route::get('/edit/{id}', 'edit')->name('editCategoria');
            Route::post('/update/{id}', 'update')->name('updateCategoria');
        });
        Route::group(['middleware' => ['permission:delete categoria']], function () {
            Route::delete('/{id}', 'destroy')->name('deleteCategoria');
        });
    });
});

// Rotas de Relatório Financeiro
Route::prefix('relatorio')->middleware('auth')->group(function () {
    Route::controller(RelatorioController::class)->group(function () {
        //Route::get('/inicial', 'index')->name('indexAplication');
        Route::group(['middleware' => ['permission:read relatorio']], function () {
            Route::get('/', 'index')->name('indexRelatorio');
            Route::get('/show/{id}', 'show')->name('showRelatorio');
            Route::get('/showRenda', 'showRenda')->name('showRelatorioRenda');
            Route::get('/showGasto', 'showGasto')->name('showRelatorioGasto');
        });
        Route::group(['middleware' => ['permission:create relatorio']], function () {
            Route::get('/create', 'create')->name('createRelatorio');
            Route::post('/store', 'store')->name('storeRelatorio');
        });
        Route::group(['middleware' => ['permission:edit relatorio']], function () {
            Route::get('/edit/{id}', 'edit')->name('editRelatorio');
            Route::post('/update/{id}', 'update')->name('updateRelatorio');
        });
        Route::group(['middleware' => ['permission:delete relatorio']], function () {
            Route::delete('/{id}', 'destroy')->name('deleteRelatorio');
        });
    });
});

// Rotas de Funções e Permissões dos Funcionários (Roles)

Route::prefix('funcoes')->middleware('auth')->group(function () {
    Route::controller(RoleController::class)->group(function () {
        Route::group(['middleware' => ['permission:read config']], function () {
            Route::get('/', 'index')->name('indexRole');
            Route::get('/show/{id}', 'show')->name('showRole');
        });
        Route::group(['middleware' => ['permission:create config']], function () {
            Route::get('/create', 'create')->name('createRole');
            Route::post('/store', 'store')->name('storeRole');
        });
        Route::group(['middleware' => ['permission:edit config']], function () {
            Route::get('/edit/{id}', 'edit')->name('editRole');
            Route::post('/update/{id}', 'update')->name('updateRole');
        });
        Route::group(['middleware' => ['permission:delete config']], function () {
            Route::delete('/{id}', 'destroy')->name('deleteRole');
        });
    });
});

// Rotas de Configuração do sistema

Route::prefix('configuracao')->middleware('auth')->group(function () {
    Route::controller(ConfigController::class)->group(function () {
        Route::group(['middleware' => ['permission:read config']], function () {
            Route::get('/', 'index')->name('indexConfig');
            Route::get('/color', 'indexColor')->name('indexColor');
            Route::get('/show/{id}', 'show')->name('showConfig');
        });
        Route::group(['middleware' => ['permission:create config']], function () {
            Route::get('/create', 'create')->name('createConfig');
            Route::post('/store', 'store')->name('storeConfig');
            Route::post('/storeColor', 'storeColor')->name('storeColor');
        });
        Route::group(['middleware' => ['permission:edit config']], function () {
            Route::get('/edit/{id}', 'edit')->name('editConfig');
            Route::post('/update/{id}', 'update')->name('updateConfig');
        });
        Route::group(['middleware' => ['permission:delete config']], function () {
            Route::delete('/{id}', 'destroy')->name('deleteConfig');
        });
    });
});

// Rotas de Administração de Usuários // Rotas de Aplication
Route::prefix('usuario')->middleware('auth')->group(function () {
    Route::controller(AplicationController::class)->group(function () {

        Route::get('/inicial', 'index')->name('indexAplication');
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/cadastro/{id}', 'cadastro')->name('cadastroAplication');

        Route::group(['middleware' => ['permission:read usuario']], function () {
            Route::get('/painel', 'painelControle')->name('painelControleUsuario');
            Route::get('/show/{id}', 'show')->name('showUsuario');
        });
        Route::group(['middleware' => ['permission:create usuario']], function () {
            Route::get('/create', 'create')->name('createUsuario');
            Route::post('/store', 'store')->name('storeUsuario');
        });
        Route::group(['middleware' => ['permission:edit usuario']], function () {
            Route::get('/edit/{id}', 'edit')->name('editUsuario');
            Route::post('/update/{id}', 'update')->name('updateUsuario');
            Route::get('/autentica-email', 'autentica_email')->middleware('verified')->name('autentica_email');
        });
        Route::group(['middleware' => ['permission:delete usuario']], function () {
            Route::delete('/{id}', 'destroy')->name('deleteUsuario');
        });
    });
});
