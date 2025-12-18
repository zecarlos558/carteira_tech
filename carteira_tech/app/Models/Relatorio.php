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

    public function setValorSaida($valorTotal)
    {
        $this->valorTotalSaida = exibirValorNulo($valorTotal);
    }

    public function setValorEntrada($valorTotal)
    {
        $this->valorTotalEntrada = exibirValorNulo($valorTotal);
    }

    public function setValorSaldo()
    {
        $this->saldoTotal = $this->valorTotalEntrada - $this->valorTotalSaida;
    }

    function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getValorSaida()
    {
        return formatarNumero($this->valorTotalSaida);
    }

    public function getValorEntrada()
    {
        return formatarNumero($this->valorTotalEntrada);
    }

    public function getValorSaldo()
    {
        return formatarNumero($this->saldoTotal);
    }

    function getTipo()
    {
        return $this->tipo;
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
    public function calculaBarraCategorias($dados, $tipo = null)
    {
        $maiorValor = $dados->max('valorTotal');
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
        return Movimento::retirada()
            ->orderBy('data', 'desc')->with('categoria');
    }

    protected static function consultaRenda()
    {
        return Movimento::suprimento()
            ->orderBy('data', 'desc')->with('categoria');
    }

    protected static function consultaTotalGastos()
    {
        return Movimento::retirada()
            ->select(DB::raw('count( movimentos.id ) as quantidade, sum( movimentos.valor ) as valorTotal'))
        ;
    }

    protected static function consultaTotalRenda()
    {
        return Movimento::suprimento()
            ->select(DB::raw('count( movimentos.id ) as quantidade, sum( movimentos.valor ) as valorTotal'))
        ;
    }

    protected static function consultaPorCategoria()
    {
        return Movimento::join('categorias', 'categorias.id', 'movimentos.categoria_id')
            ->select(DB::raw('categorias.id as id, categorias.nome as nome, movimentos.tipo as tipo, 
                         sum(movimentos.valor) as valorTotal'))
            ->groupBy('categorias.id', 'categorias.nome', 'movimentos.tipo')
            ->orderBy('valor', 'asc')
        ;
    }
}
