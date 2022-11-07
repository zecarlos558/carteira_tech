<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Movimento;

class Relatorio extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $valorTotalEntrada;
    public $valorTotalSaida;

    public $saldoTotal;

    public $barraProgressoSaida;
    public $barraProgressoEntrada;

    public $tipo;

    public function construtorSaida($dados)
    {
        $this->valorTotalSaida = exibirValorNulo($dados->valorTotalSaida) ;
    }

    public function construtorEntrada($dados)
    {
        $this->valorTotalEntrada = exibirValorNulo($dados->valorTotalEntrada) ;
    }

    public function construtorSaldo()
    {
        $this->saldoTotal = $this->valorTotalSaida - $this->valorTotalEntrada;
    }

    // Calcula Barra de Progresso do index
    public function calculaBarraProgresso()
    {
        $valorTotalEntrada = $this->valorTotalEntrada;
        $valorTotalSaida = $this->valorTotalSaida;
        if ($valorTotalEntrada > $valorTotalSaida) {
            $this->barraProgressoEntrada = 100;
            $this->barraProgressoSaida = (($valorTotalSaida * 100) / $valorTotalEntrada);
        } elseif ($valorTotalSaida > $valorTotalEntrada) {
            $this->barraProgressoSaida = 100;
            $this->barraProgressoEntrada = (($valorTotalEntrada * 100) / $valorTotalSaida);
        } else {
            $this->barraProgressoEntrada = 0;
            $this->barraProgressoSaida = 0;
        }

    }

    // Calcula Barra de Progresso dos Categorias no resumo detalhado
    public function calculaBarraCategorias($dados,$tipo=null)
    {
        $maiorValor = maiorValorArray($dados,'valorTotal');
        $valorTotalEntrada = $this->valorTotalEntrada;
        $valorTotalSaida = $this->valorTotalSaida;
        $valorTotal = $valorTotalEntrada + $valorTotalSaida;

        foreach ($dados as $key => $dado) {
            $dado->barraProgresso = (($dado->valorTotal * 100) / $maiorValor);
            if ($tipo == 'saida') {
                $dado->percentualSaida = (($dado->valorTotal * 100) / $valorTotalSaida);
                $dado->percentualSaida = number_format($dado->percentualSaida, 2, '.', ' ');
            } elseif ($tipo == 'entrada') {
                $dado->percentualEntrada = (($dado->valorTotal * 100) / $valorTotalEntrada);
                $dado->percentualEntrada = number_format($dado->percentualEntrada, 2, '.', ' ');
            } else {
                $dado->percentual = (($dado->valorTotal * 100) / $valorTotal);
                $dado->percentual = number_format($dado->percentual, 2, '.', ' ');
            }
        }
        return $dados;
    }

    protected static function consultaGastos()
    {
        return DB::table('movimentos')
        ->where('user_id_create',Aplication::consultaIDUsuario())
        ->where('tipo','retirada')
        ;
    }

    protected static function consultaRenda()
    {
        return DB::table('movimentos')
        ->where('user_id_create',Aplication::consultaIDUsuario())
        ->where('tipo','suprimento')
        ;
    }

    protected static function consultaTotalGastos()
    {
        return DB::table('movimentos')
        ->where('user_id_create',Aplication::consultaIDUsuario())
        ->where('tipo','retirada')
        ->select(DB::raw('count( movimentos.id ) as quantidade, sum( movimentos.valor ) as valorTotalSaida'))
        ;
    }

    protected static function consultaTotalRenda()
    {
        return DB::table('movimentos')
        ->where('user_id_create',Aplication::consultaIDUsuario())
        ->where('tipo','suprimento')
        ->select(DB::raw('count( movimentos.id ) as quantidade, sum( movimentos.valor ) as valorTotalEntrada'))
        ;
    }

    protected static function consultaPorCategoria()
    {
        return DB::table('movimentos')
        ->join('categorias','categorias.id','movimentos.categoria_id')
        ->where('movimentos.user_id_create',Aplication::consultaIDUsuario())
        ->select(DB::raw('categorias.id as id, categorias.nome as nome, sum(movimentos.valor) as valorTotal'))
        ->groupBy('categorias.id','categorias.nome')
        ->orderBy('valor','desc')
        ;
    }


}
