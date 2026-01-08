<?php

namespace App\Http\Controllers;

use App\Classes\Planilha;
use App\Classes\Tcpdf;
use App\Classes\XLS;
use App\Models\Categoria;
use App\Models\Conta;
use App\Models\Movimento;
use App\Models\Relatorio;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parametros = $request->except("_token");
        $parametros['data'] = $request->data ?? date('Y-m-d');
        $parametros["opcao_data"] = $request->opcao_data ?? "mensal";
        if ($parametros["opcao_data"] == "personalizado") {
            $parametros['dataInicio'] = $parametros['dataInicio'] . '-01';
            $parametros['dataFim'] = date($parametros['dataFim'] . '-t');
        }

        $dadosRenda = Relatorio::consultaTotalRenda()
            ->lancamentoEntreContas()
            ->when($parametros["opcao_data"] == "mensal", function ($query) use ($parametros) {
                $query->whereMonth('data', '=', formatarData($parametros['data'], 'm'))
                    ->whereYear('data', '=', formatarData($parametros['data'], 'Y'));
            })
            ->when($parametros["opcao_data"] == "personalizado", function ($query) use ($parametros) {
                $query->whereBetween('data', [$parametros['dataInicio'], $parametros['dataFim']]);
            })
            ->first();
        $dadosGastos = Relatorio::consultaTotalGastos()
            ->lancamentoEntreContas()
            ->when($parametros["opcao_data"] == "mensal", function ($query) use ($parametros) {
                $query->whereMonth('data', '=', formatarData($parametros['data'], 'm'))
                    ->whereYear('data', '=', formatarData($parametros['data'], 'Y'));
            })
            ->when($parametros["opcao_data"] == "personalizado", function ($query) use ($parametros) {
                $query->whereBetween('data', [$parametros['dataInicio'], $parametros['dataFim']]);
            })
            ->first();

        $relatorio = new Relatorio;
        $relatorio->setValorSaida($dadosGastos->valorTotal);
        $relatorio->setValorEntrada($dadosRenda->valorTotal);
        $relatorio->setValorSaldo();

        $relatorioCategorias = Relatorio::consultaPorCategoria()
            ->when($parametros["opcao_data"] == "mensal", function ($query) use ($parametros) {
                $query->whereMonth('data', '=', formatarData($parametros['data'], 'm'))
                    ->whereYear('data', '=', formatarData($parametros['data'], 'Y'));
            })
            ->when($parametros["opcao_data"] == "personalizado", function ($query) use ($parametros) {
                $query->whereBetween('data', [$parametros['dataInicio'], $parametros['dataFim']]);
            })
            ->get()->sortByDesc("valorTotal");

        $relatorio->calculaBarraCategorias($relatorioCategorias);
        $parametros['desc_data'] = formataDataRelatorio($parametros);

        return view('relatorios.index', [
            'relatorio' => $relatorio,
            'parametros' => $parametros,
            'relatorioCategorias' => $relatorioCategorias
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_movimentos = [["codigo" => "suprimento", "descricao" => "Suprimento"], ["codigo" => "retirada", "descricao" => "Retirada"]];
        $tipo_contas = Conta::with('tipos')->get()->groupBy('tipo.nome');
        $grupo_categorias = Categoria::with('grupos')->get()->groupBy('grupo.nome');

        return view(
            "relatorios.create",
            [
                "tipo_movimentos" => $tipo_movimentos,
                "tipo_contas" => $tipo_contas,
                "grupo_categorias" => $grupo_categorias
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "formato_relatorio" => "required|in:PDF,XLS"
        ]);
        $parametros = $request->all();
        if ($parametros["opcao_data"] == "personalizado") {
            $parametros['dataInicio'] = $parametros['dataInicio'] . '-01';
            $parametros['dataFim'] = date($parametros['dataFim'] . '-t');
        }
        $dadosRenda = Relatorio::consultaTotalRenda()
            ->lancamentoEntreContas()
            ->when($parametros["opcao_data"] == "mensal", function ($query) use ($parametros) {
                $query->whereMonth('data', '=', formatarData($parametros['data'], 'm'))
                    ->whereYear('data', '=', formatarData($parametros['data'], 'Y'));
            })
            ->when($parametros["opcao_data"] == "personalizado", function ($query) use ($parametros) {
                $query->whereBetween('data', [$parametros['dataInicio'], $parametros['dataFim']]);
            })
            ->when($parametros["categoria_id"], function ($query) use ($parametros) {
                $query->whereHas("categoria", fn($q) => $q->where("id", "=", $parametros["categoria_id"]));
            })
            ->when($parametros["conta_id"], function ($query) use ($parametros) {
                $query->whereHas("conta", fn($q) => $q->where("id", "=", $parametros["conta_id"]));
            })
            ->when($parametros["tipo"], fn($q) => $q->where("tipo", "=", $parametros["tipo"]))
            ->when($parametros["descricao"], fn($q) => $q->whereRaw("(lower(movimentos.nome)) like ?", ["%" . strtolower(($parametros["descricao"])) . "%"])
                ->orWhereRaw("(lower(descricao)) like ?", ["%" . strtolower(($parametros["descricao"])) . "%"]))
            ->first();
        $dadosGastos = Relatorio::consultaTotalGastos()
            ->lancamentoEntreContas()
            ->when($parametros["opcao_data"] == "mensal", function ($query) use ($parametros) {
                $query->whereMonth('data', '=', formatarData($parametros['data'], 'm'))
                    ->whereYear('data', '=', formatarData($parametros['data'], 'Y'));
            })
            ->when($parametros["opcao_data"] == "personalizado", function ($query) use ($parametros) {
                $query->whereBetween('data', [$parametros['dataInicio'], $parametros['dataFim']]);
            })
            ->when($parametros["categoria_id"], function ($query) use ($parametros) {
                $query->whereHas("categoria", fn($q) => $q->where("id", "=", $parametros["categoria_id"]));
            })
            ->when($parametros["conta_id"], function ($query) use ($parametros) {
                $query->whereHas("conta", fn($q) => $q->where("id", "=", $parametros["conta_id"]));
            })
            ->when($parametros["tipo"], fn($q) => $q->where("tipo", "=", $parametros["tipo"]))
            ->when($parametros["descricao"], fn($q) => $q->whereRaw("(lower(movimentos.nome)) like ?", ["%" . strtolower(($parametros["descricao"])) . "%"])
                ->orWhereRaw("(lower(descricao)) like ?", ["%" . strtolower(($parametros["descricao"])) . "%"]))
            ->first();

        $relatorio = new Relatorio;
        $relatorio->setValorSaida($dadosGastos->valorTotal);
        $relatorio->setValorEntrada($dadosRenda->valorTotal);
        $relatorio->setValorSaldo();

        $relatorioCategorias = Relatorio::consultaPorCategoria()
            ->when($parametros["opcao_data"] == "mensal", function ($query) use ($parametros) {
                $query->whereMonth('data', '=', formatarData($parametros['data'], 'm'))
                    ->whereYear('data', '=', formatarData($parametros['data'], 'Y'));
            })
            ->when($parametros["opcao_data"] == "personalizado", function ($query) use ($parametros) {
                $query->whereBetween('data', [$parametros['dataInicio'], $parametros['dataFim']]);
            })
            ->when($parametros["categoria_id"], function ($query) use ($parametros) {
                $query->whereHas("categoria", fn($q) => $q->where("id", "=", $parametros["categoria_id"]));
            })
            ->when($parametros["conta_id"], function ($query) use ($parametros) {
                $query->whereHas("conta", fn($q) => $q->where("id", "=", $parametros["conta_id"]));
            })
            ->when($parametros["tipo"], fn($q) => $q->where("tipo", "=", $parametros["tipo"]))
            ->when($parametros["descricao"], fn($q) => $q->whereRaw("(lower(movimentos.nome)) like ?", ["%" . strtolower(($parametros["descricao"])) . "%"])
                ->orWhereRaw("(lower(descricao)) like ?", ["%" . strtolower(($parametros["descricao"])) . "%"]))
            ->get()->sortByDesc("valorTotal");

        $relatorio->calculaBarraCategorias($relatorioCategorias);

        $ultimaChave = count($relatorioCategorias) - 1;
        if ($request->exibe_transacao == "true" && $ultimaChave >= 0) {
            $movimentos_tipos = Movimento::when($parametros["opcao_data"] == "mensal", function ($query) use ($parametros) {
                $query->whereMonth('data', '=', formatarData($parametros['data'], 'm'))
                    ->whereYear('data', '=', formatarData($parametros['data'], 'Y'));
            })
                ->when($parametros["opcao_data"] == "personalizado", function ($query) use ($parametros) {
                    $query->whereBetween('data', [$parametros['dataInicio'], $parametros['dataFim']]);
                })
                ->when($parametros["categoria_id"], function ($query) use ($parametros) {
                    $query->whereHas("categoria", fn($q) => $q->where("id", "=", $parametros["categoria_id"]));
                })
                ->when($parametros["conta_id"], function ($query) use ($parametros) {
                    $query->whereHas("conta", fn($q) => $q->where("id", "=", $parametros["conta_id"]));
                })
                ->when($parametros["tipo"], fn($q) => $q->where("tipo", "=", $parametros["tipo"]))
                ->when($parametros["descricao"], fn($q) => $q->whereRaw("(lower(movimentos.nome)) like ?", ["%" . strtolower(($parametros["descricao"])) . "%"])
                    ->orWhereRaw("(lower(descricao)) like ?", ["%" . strtolower(($parametros["descricao"])) . "%"]))
                ->select("id", "nome", "descricao", "valor", "data", "tipo", "categoria_id")
                ->with(["categoria" => fn($q) => $q->select("id", "nome")])
                ->orderBy("data", "desc")->orderby("valor", "desc")
                ->get()->groupBy("tipo");
        } else {
            $movimentos_tipos = collect([]);
        }
        switch ($parametros['formato_relatorio']) {
            case 'PDF':
                return $this->financeiroPersonalizadoPDF($parametros, $relatorio, $relatorioCategorias, $movimentos_tipos);
                break;
            case 'XLS':
                return $this->financeiroPersonalizadoXLS($parametros, $relatorio, $relatorioCategorias, $movimentos_tipos);
                break;
        }
    }

    public function financeiroPersonalizadoPDF($parametros, $relatorio, $relatorioCategorias, $movimentos_tipos)
    {
        $pdf = new Tcpdf();
        $pdf->SetFont('helvetica', 'BI', 12);
        $pdf->setTitle("Relatório Financeiro - Carteira Tech");
        $pdf->AddPage();
        $pdf->Ln(10);
        $descricao_data = formataDataRelatorio($parametros);
        $pdf->Cell(0, 5, "Referência: $descricao_data", 0, 1, "L");
        if ($parametros['categoria_id']) {
            $categoria = Categoria::find($parametros['categoria_id']);
            $pdf->Cell(0, 5, "Categoria: $categoria->nome", 0, 1, "L");
        }
        if ($parametros['conta_id']) {
            $conta = Conta::find($parametros['conta_id']);
            $pdf->Cell(0, 5, "Conta: $conta->nome", 0, 1, "L");
        }
        if ($parametros['tipo']) {
            $tipo = ucfirst($parametros['tipo']);
            $pdf->Cell(0, 5, "Tipo: $tipo", 0, 1, "L");
        }
        if ($parametros['descricao']) {
            $pdf->Cell(0, 5, "Descrição: " . $parametros['descricao'], 0, 1, "L");
        }
        $pdf->SetFont('times', 'B', 15);
        $pdf->Ln(6);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFillColor(0, 255, 0);
        $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0)));
        $pdf->Cell(90, 8, "Renda", 1, 0, 'C', 1);
        $pdf->Cell(0.5, 8, "", 0, 0, 'C', 0);
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0)));
        $pdf->Cell(90, 8, "Gasto", 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0)));
        $pdf->Cell(90, 14, $relatorio->getValorEntrada(), 1, 0, 'C', 0);
        $pdf->Cell(0.5, 8, "", 0, 0, 'C', 0);
        $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0)));
        $pdf->Cell(90, 14, $relatorio->getValorSaida(), 1, 0, 'C', 0);
        $pdf->SetFillColor(205, 205, 205);
        $pdf->Ln(20);
        $pdf->SetLineStyle(array('width' => 0.25, 'color' => array(0, 0, 0)));
        $pdf->Cell(90, 7, "Categorias", "TBL", 0, "L", 1);
        $pdf->Cell(90, 7, "Saldo Total: " . $relatorio->getValorSaldo(), "TBR", 1, "R", 1);
        // Obtém as margens e dimensões da página
        $page_width = $pdf->getPageWidth();
        $page_height = $pdf->getPageHeight();
        $margin_left = $pdf->getMargins()['left'];
        $margin_right = $pdf->getMargins()['right'];
        $margem_x_original = $pdf->GetX();
        $margin_top = $pdf->GetY();
        $margem_x_categorias = $margem_x_original + 5;
        $estilo_borda_pagina = array(
            'width' => 0.1,
            'cap' => 'butt',
            'join' => 'miter',
            'dash' => 0,
            'color' => array(0, 0, 0)
        );
        $pdf->SetFont('helvetica', 'BI', 11);
        $ultimaChave = count($relatorioCategorias) - 1;
        foreach ($relatorioCategorias->values() as $key => $categoria) {
            $pdf->setX($margem_x_categorias);
            $pdf->Cell(0, 5, "$categoria->nome =>" . ($categoria->tipo == "suprimento" ? " + " : " - ") . formatarNumero($categoria->valorTotal), 0, 1, "L");
            $color_array = $categoria->tipo == "suprimento" ? array(0, 255, 0)  : array(255, 0, 0);
            $pdf->setX($margem_x_categorias);
            $barra_progresso = round(($categoria->barraProgresso * ($pdf->getPageWidth() - 40)) / 100, 1);
            $pdf->RoundedRect($pdf->GetX(), $pdf->GetY(), $barra_progresso, 3, $barra_progresso > 2 ? 1.5 : 0.2, '1111', 'DF', array(), $color_array);
            $pdf->ln(5);
            $margin_bottom = $pdf->GetY();
            $pdf->Rect(
                $margin_left, // x inicial
                $margin_top, // y inicial
                $page_width - $margin_left - $margin_right, // largura
                $margin_bottom - $margin_top + 15, // altura
                'D',
                array("L" => $estilo_borda_pagina, "R" => $estilo_borda_pagina, "B" => ($ultimaChave ==  $key ? $estilo_borda_pagina : [])),
                array()
            );
        }
        if ($movimentos_tipos->isNotEmpty()) {
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetLineStyle(array('width' => 0.25, 'color' => array(0, 0, 0)));
            $pdf->Ln(10);
            $pdf->SetFillColor(205, 205, 205);
            $pdf->Cell(0, 6, "Transações", 1, 1, "C", 1);
            $pdf->SetFillColor(0, 255, 0);
            $pdf->Cell(90, 5, "Suprimento", 1, 0, "C", 1);
            $pdf->SetFillColor(255, 0, 0);
            $pdf->Cell(90, 5, "Retirada", 1, 1, "C", 1);
            $max_value = $movimentos_tipos->max(fn($q) => $q->count());
            $pdf->SetFont('helvetica', '', 9);
            $margem_y_movimento = $pdf->GetY();
            for ($i = 0; $i < $max_value; $i++) {
                foreach (['suprimento', 'retirada'] as $key => $tipo) {
                    if (isset($movimentos_tipos[$tipo][$i])) {
                        $movimento = $movimentos_tipos[$tipo][$i];
                        $descricao_categoria = $movimento->categoria->nome;
                        $descricao_movimento = $movimento->nome;
                        $data_movimento = formatarData($movimento->data);
                        $valor_movimento = $movimento->getValor();
                    } else {
                        $descricao_categoria = $descricao_movimento = $data_movimento = $valor_movimento = "";
                    }
                    $pdf->Cell(70, 4, truncate($descricao_categoria, 39), "LT", 0, "L");
                    $pdf->Cell(20, 4, $data_movimento, "RT", 0, "L");
                }
                $pdf->Ln();
                foreach (['suprimento', 'retirada'] as $key => $tipo) {
                    if (isset($movimentos_tipos[$tipo][$i])) {
                        $movimento = $movimentos_tipos[$tipo][$i];
                        $descricao_categoria = $movimento->categoria->nome;
                        $descricao_movimento = $movimento->nome;
                        $data_movimento = formatarData($movimento->data);
                        $valor_movimento = $movimento->getValor();
                    } else {
                        $descricao_categoria = $descricao_movimento = $data_movimento = $valor_movimento = "";
                    }
                    $pdf->Cell(70, 4, truncate($descricao_movimento, 39), "LB", 0, "L");
                    $pdf->Cell(20, 4, $valor_movimento, "RB", 0, "L");
                }
                $pdf->Ln();
            }
        }
        $pdf->Output("Relatório Financeiro.pdf", "I");
    }

    public function financeiroPersonalizadoXLS($parametros, $relatorio, $relatorioCategorias, $movimentos_tipos)
    {
        $planilha = new Planilha();
        $sheet = $planilha->getActiveSheet();
        $sheet = $planilha->Header($sheet);
        $indice = 4;
        $descricao_data = formataDataRelatorio($parametros);
        $sheet->setCellValue('A' . $indice, "Referência: $descricao_data")->getStyle('A' . $indice);
        $sheet->mergeCells('A' . $indice . ':J' . $indice);
        if ($parametros['categoria_id']) {
            $indice++;
            $categoria = Categoria::find($parametros['categoria_id']);
            $sheet->setCellValue('A' . $indice, "Categoria: $categoria->nome")->getStyle('A' . $indice);
            $sheet->mergeCells('A' . $indice . ':J' . $indice);
        }
        if ($parametros['conta_id']) {
            $indice++;
            $conta = Conta::find($parametros['conta_id']);
            $sheet->setCellValue('A' . $indice, "Conta: $conta->nome")->getStyle('A' . $indice);
            $sheet->mergeCells('A' . $indice . ':J' . $indice);
        }
        if ($parametros['tipo']) {
            $indice++;
            $tipo = ucfirst($parametros['tipo']);
            $sheet->setCellValue('A' . $indice, "Tipo: $tipo")->getStyle('A' . $indice);
            $sheet->mergeCells('A' . $indice . ':J' . $indice);
        }
        if ($parametros['descricao']) {
            $indice++;
            $sheet->setCellValue('A' . $indice, "Descrição: " . $parametros['descricao'])->getStyle('A' . $indice);
            $sheet->mergeCells('A' . $indice . ':J' . $indice);
        }
        $indice++;
        $sheet->mergeCells('A' . $indice . ':J' . $indice);
        $indice++;
        $style_renda_cabecalho = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_PATTERN_DARKGRAY,
                'startColor' => [
                    'argb' => "99CC32"
                ]
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOTTED,
                    'color' => ['argb' => "000000"]
                ]
            ],
            'font' => [
                'bold' => true,
                'italic' => false,
                'name' => 'Verdana',
                'color' => ['argb' => "FFFFFF"]
            ]
        ];
        $style_gasto_cabecalho = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_PATTERN_DARKGRAY,
                'startColor' => [
                    'argb' => "FF0000"
                ]
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOTTED,
                    'color' => ['argb' => "000000"]
                ]
            ],
            'font' => [
                'bold' => true,
                'italic' => false,
                'name' => 'Verdana',
                'color' => ['argb' => "FFFFFF"]
            ]
        ];
        $sheet->setCellValue('A' . $indice, "RENDA")->getStyle('A' . $indice)->applyFromArray($style_renda_cabecalho);
        $sheet->mergeCells('A' . $indice . ':E' . $indice);
        $sheet->setCellValue('F' . $indice, "GASTO")->getStyle('F' . $indice)->applyFromArray($style_gasto_cabecalho);
        $sheet->mergeCells('F' . $indice . ':J' . $indice);
        $sheet->getStyle('A' . $indice . ':E' . $indice)->getAlignment()->setHorizontal($planilha->HORIZONTAL_CENTER);
        $sheet->getStyle('A' . $indice . ':E' . $indice)->getAlignment()->setVertical($planilha->VERTICAL_CENTER);
        $sheet->getStyle('F' . $indice . ':J' . $indice)->getAlignment()->setHorizontal($planilha->HORIZONTAL_CENTER);
        $sheet->getStyle('F' . $indice . ':J' . $indice)->getAlignment()->setVertical($planilha->VERTICAL_CENTER);
        $indice++;
        $style_valores_corpo = [
            'font' => [
                'bold' => true,
                'italic' => false,
                'name' => 'Verdana',
                'size' => 12
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => "000000"]
                ]
            ]
        ];
        $sheet->setCellValue('A' . $indice, $relatorio->getValorEntrada())->getStyle('A' . $indice)->applyFromArray($style_valores_corpo);
        $sheet->mergeCells('A' . $indice . ':E' . $indice + 1);
        $sheet->setCellValue('F' . $indice, $relatorio->getValorSaida())->getStyle('F' . $indice)->applyFromArray($style_valores_corpo);
        $sheet->mergeCells('F' . $indice . ':J' . $indice + 1);
        $sheet->getStyle('A' . $indice . ':E' . $indice)->getAlignment()->setHorizontal($planilha->HORIZONTAL_CENTER);
        $sheet->getStyle('A' . $indice . ':E' . $indice)->getAlignment()->setVertical($planilha->VERTICAL_CENTER);
        $sheet->getStyle('F' . $indice . ':J' . $indice)->getAlignment()->setHorizontal($planilha->HORIZONTAL_CENTER);
        $sheet->getStyle('F' . $indice . ':J' . $indice)->getAlignment()->setVertical($planilha->VERTICAL_CENTER);
        $indice = $indice + 2;
        $sheet->mergeCells('A' . $indice . ':J' . $indice);
        $indice++;
        $sheet->setCellValue('A' . $indice, "Categorias")->getStyle('A' . $indice)->applyFromArray($planilha->style_titulo);
        $sheet->mergeCells('A' . $indice . ':E' . $indice);
        $sheet->setCellValue('F' . $indice, "Saldo Total: " . $relatorio->getValorSaldo())->getStyle('F' . $indice)->applyFromArray($planilha->style_titulo);
        $sheet->mergeCells('F' . $indice . ':J' . $indice);
        $sheet->getStyle('F' . $indice . ':J' . $indice)->getAlignment()->setHorizontal($planilha->HORIZONTAL_RIGHT);
        $indice++;
        foreach ($relatorioCategorias as $key => $categoria) {
            $sheet->setCellValue('A' . $indice, "$categoria->nome =>" . ($categoria->tipo == "suprimento" ? " + " : " - ") . formatarNumero($categoria->valorTotal))->getStyle('A' . $indice);
            $sheet->mergeCells('A' . $indice . ':J' . $indice);
            $indice++;
        }
        $sheet->mergeCells('A' . $indice . ':J' . $indice);
        $indice++;
        if ($movimentos_tipos->isNotEmpty()) {
            $sheet->setCellValue('A' . $indice, "Transações")->getStyle('A' . $indice)->applyFromArray($planilha->style_titulo);
            $sheet->getStyle('A' . $indice . ':E' . $indice)->getAlignment()->setHorizontal($planilha->HORIZONTAL_CENTER);
            $sheet->getStyle('A' . $indice . ':E' . $indice)->getAlignment()->setVertical($planilha->VERTICAL_CENTER);
            $sheet->mergeCells('A' . $indice . ':J' . $indice);
            $indice++;
            $sheet->setCellValue('A' . $indice, "Suprimento")->getStyle('A' . $indice)->applyFromArray($style_renda_cabecalho);
            $sheet->mergeCells('A' . $indice . ':E' . $indice);
            $sheet->setCellValue('F' . $indice, "Retirada")->getStyle('F' . $indice)->applyFromArray($style_gasto_cabecalho);
            $sheet->mergeCells('F' . $indice . ':J' . $indice);
            $sheet->getStyle('A' . $indice . ':E' . $indice)->getAlignment()->setHorizontal($planilha->HORIZONTAL_CENTER);
            $sheet->getStyle('A' . $indice . ':E' . $indice)->getAlignment()->setVertical($planilha->VERTICAL_CENTER);
            $sheet->getStyle('F' . $indice . ':J' . $indice)->getAlignment()->setHorizontal($planilha->HORIZONTAL_CENTER);
            $sheet->getStyle('F' . $indice . ':J' . $indice)->getAlignment()->setVertical($planilha->VERTICAL_CENTER);
            $indice++;
            $max_value = $movimentos_tipos->max(fn($q) => $q->count());
            for ($i = 0; $i < $max_value; $i++) {
                foreach (['suprimento', 'retirada'] as $key => $tipo) {
                    if (isset($movimentos_tipos[$tipo][$i])) {
                        $movimento = $movimentos_tipos[$tipo][$i];
                        $descricao_categoria[$tipo] = $movimento->categoria->nome;
                        $descricao_movimento[$tipo] = $movimento->nome;
                        $data_movimento[$tipo] = formatarData($movimento->data);
                        $valor_movimento[$tipo] = $movimento->getValor();
                    } else {
                        $descricao_categoria[$tipo] = $descricao_movimento[$tipo] = $data_movimento[$tipo] = $valor_movimento[$tipo] = "";
                    }
                }
                $sheet->setCellValue('A' . $indice, $descricao_categoria['suprimento'] . "\n" . $descricao_movimento['suprimento'])->getStyle('A' . $indice);
                $sheet->mergeCells('A' . $indice . ':C' . $indice + 1);
                $sheet->setCellValue('D' . $indice, $data_movimento['suprimento'] . "\n" . $valor_movimento['suprimento'])->getStyle('A' . $indice);
                $sheet->mergeCells('D' . $indice . ':E' . $indice + 1);
                $sheet->setCellValue('F' . $indice, $descricao_categoria['retirada'] . "\n" . $descricao_movimento['retirada'])->getStyle('A' . $indice);
                $sheet->mergeCells('F' . $indice . ':H' . $indice + 1);
                $sheet->setCellValue('I' . $indice, $data_movimento['retirada'] . "\n" . $valor_movimento['retirada'])->getStyle('A' . $indice);
                $sheet->mergeCells('I' . $indice . ':J' . $indice + 1);
                $indice = $indice + 2;
            }
        }

        $xls = new XLS($planilha);
        try {
            $xls->gerar("relatorio_financeiro");
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function showRenda(Request $request)
    {
        if ($request->data != null) {
            $data = formatarData($request->data, 'Y-m-d');
        } else {
            $data = date('Y-m-d');
        }
        $dadosRendaMensal = Relatorio::consultaTotalRenda()
            ->lancamentoEntreContas()
            ->addSelect(DB::raw("EXTRACT(YEAR_MONTH FROM data) as mes_ano"))
            ->groupBy(DB::raw("EXTRACT(YEAR_MONTH FROM data)"))
            ->orderBy('data', 'desc')
            ->get();

        $dados = $request->all(['opcao_data', 'dataInicio', 'dataFim']);
        $dados["data"] = $data;
        $movimentos = Relatorio::consultaRenda();
        $dadosRenda = Relatorio::consultaTotalRenda()->lancamentoEntreContas();
        $relatorioCategorias = Relatorio::consultaPorCategoria();

        if (count($dados) > 0 && @$dados['opcao_data'] == 'personalizado') {
            $dados['dataInicio'] = strlen($dados['dataInicio']) < 9 ? $dados['dataInicio'] . '-01' : $dados['dataInicio'];
            $dados['dataFim'] = strlen($dados['dataFim']) < 9 ? date($dados['dataFim'] . '-t') : $dados['dataFim'];
            $movimentos = $movimentos->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
                ->orderBy("data", "desc")
                ->get();
            $dadosRenda = $dadosRenda->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
                ->first();
            $relatorioCategorias = $relatorioCategorias->suprimento()
                ->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
                ->get()->sortByDesc("valorTotal");
        } else {
            if (isset($dados['opcao_data']) && $dados['opcao_data'] == 'mensal') {
                $data = $dados['data'];
            } else {
                $dados['opcao_data'] = "mensal";
            }
            $movimentos = $movimentos->whereMonth('data', '=', formatarData($data, 'm'))
                ->whereYear('data', '=', formatarData($data, 'Y'))
                ->orderBy("data", "desc")
                ->get();
            $dadosRenda = $dadosRenda->whereMonth('data', '=', formatarData($data, 'm'))
                ->whereYear('data', '=', formatarData($data, 'Y'))
                ->first();
            $relatorioCategorias = $relatorioCategorias->suprimento()
                ->whereMonth('data', '=', formatarData($data, 'm'))
                ->whereYear('data', '=', formatarData($data, 'Y'))
                ->get()->sortByDesc("valorTotal");
        }
        $dados['desc_data'] = formataDataRelatorio($dados);

        $dadosRendaMensal->map(function ($dado) {
            $data = formata_year_month($dado->mes_ano);
            $dado->mes_ano = $data['mes'] . '/' . $data['ano'];
            $dado->mes_ano_datetime = DateTime::createFromFormat('d/m/Y', "01/$dado->mes_ano");
        });
        // Preenche valores para chart Saida Percentual
        $dadosChart['doughnut'] = $relatorioCategorias->pluck("valorTotal", "nome");
        // Preenche valores para chart Saidas por Mês
        $dadosChart['bar'] = $dadosRendaMensal->pluck("valorTotal", "mes_ano");

        $relatorio = new Relatorio;
        $relatorio->setTipo('suprimento');
        $relatorio->setValorEntrada($dadosRenda->valorTotal, 'entrada');
        $relatorio->calculaBarraCategorias($relatorioCategorias);
        $mediaMensal = $dadosRendaMensal->when($dados['opcao_data'] == 'personalizado', function ($query) use ($dados) {
            $data_inicio = DateTime::createFromFormat('Y-m-d', $dados['dataInicio'])->format("Y-m-01");
            $data_fim = DateTime::createFromFormat('Y-m-d', $dados['dataFim'])->format("Y-m-01");
            return $query->filter(fn($q) => ($q->mes_ano_datetime->format("Y-m-01") >= $data_inicio) && ($q->mes_ano_datetime->format("Y-m-01") <= $data_fim));
        })->when($dados['opcao_data'] == 'mensal', function ($query) use ($dados) {
            $data = DateTime::createFromFormat('Y-m-d', $dados['data'])->format('Ym');
            return $query->filter(fn($q) => $q->mes_ano_datetime->format('Ym') == $data);
        });
        $relatorio->mediaMensal = $mediaMensal->sum("valorTotal") / divisaoZero($mediaMensal->count());

        return view('relatorios.showRenda', [
            'parametros' => $dados,
            'array' => $dadosChart,
            'movimentos' => $movimentos,
            'relatorio' => $relatorio,
            'relatorioCategorias' => $relatorioCategorias
        ])->render();
    }

    public function showGasto(Request $request)
    {
        if ($request->data != null) {
            $data = formatarData($request->data, 'Y-m-d');
        } else {
            $data = date('Y-m-d');
        }
        $dadosGastoMensal = Relatorio::consultaTotalGastos()
            ->lancamentoEntreContas()
            ->addSelect(DB::raw('EXTRACT(YEAR_MONTH FROM data) as mes_ano'))
            ->groupBy(DB::raw('EXTRACT(YEAR_MONTH FROM data)'))
            ->orderBy('data', 'desc')
            ->get();

        $dados = $request->all(['opcao_data', 'dataInicio', 'dataFim']);
        $dados["data"] = $data;
        $movimentos = Relatorio::consultaGastos();
        $dadosGasto = Relatorio::consultaTotalGastos()->lancamentoEntreContas();
        $relatorioCategorias = Relatorio::consultaPorCategoria();

        if (count($dados) > 0 && @$dados['opcao_data'] == 'personalizado') {
            $dados['dataInicio'] = strlen($dados['dataInicio']) < 9 ? $dados['dataInicio'] . '-01' : $dados['dataInicio'];
            $dados['dataFim'] = strlen($dados['dataFim']) < 9 ? date($dados['dataFim'] . '-t') : $dados['dataFim'];
            $movimentos = $movimentos->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
                ->orderBy("data", "desc")
                ->get();
            $dadosGasto = $dadosGasto->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
                ->first();
            $relatorioCategorias = $relatorioCategorias->retirada()
                ->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
                ->get()->sortByDesc("valorTotal");
            $data = $dados;
        } else {
            if (isset($dados['opcao_data']) && $dados['opcao_data'] == 'mensal') {
                $data = $dados['data'];
            } else {
                $dados['opcao_data'] = "mensal";
            }
            $movimentos = $movimentos->whereMonth('data', '=', formatarData($data, 'm'))
                ->whereYear('data', '=', formatarData($data, 'Y'))
                ->orderBy("data", "desc")
                ->get();
            $dadosGasto = $dadosGasto->whereMonth('data', '=', formatarData($data, 'm'))
                ->whereYear('data', '=', formatarData($data, 'Y'))
                ->first();
            $relatorioCategorias = $relatorioCategorias->retirada()
                ->whereMonth('data', '=', formatarData($data, 'm'))
                ->whereYear('data', '=', formatarData($data, 'Y'))
                ->get()->sortByDesc("valorTotal");
        }
        $dados['desc_data'] = formataDataRelatorio($dados);

        $dadosGastoMensal->map(function ($dado) {
            $data = formata_year_month($dado->mes_ano);
            $dado->mes_ano = $data['mes'] . '/' . $data['ano'];
            $dado->mes_ano_datetime = DateTime::createFromFormat('d/m/Y', "01/$dado->mes_ano");
        });

        // Preenche valores para chart Saida Percentual
        $dadosChart['doughnut'] = $relatorioCategorias->pluck("valorTotal", "nome");
        // Preenche valores para chart Saidas por Mês
        $dadosChart['bar'] = $dadosGastoMensal->pluck("valorTotal", "mes_ano");

        $relatorio = new Relatorio;
        $relatorio->setTipo('retirada');
        $relatorio->setValorSaida($dadosGasto->valorTotal, 'saida');
        $relatorio->calculaBarraCategorias($relatorioCategorias);
        $mediaMensal = $dadosGastoMensal->when($dados['opcao_data'] == 'personalizado', function ($query) use ($dados) {
            $data_inicio = DateTime::createFromFormat('Y-m-d', $dados['dataInicio'])->format("Y-m-01");
            $data_fim = DateTime::createFromFormat('Y-m-d', $dados['dataFim'])->format("Y-m-01");
            return $query->filter(fn($q) => ($q->mes_ano_datetime->format("Y-m-01") >= $data_inicio) && ($q->mes_ano_datetime->format("Y-m-01") <= $data_fim));
        })->when($dados['opcao_data'] == 'mensal', function ($query) use ($dados) {
            $data = DateTime::createFromFormat('Y-m-d', $dados['data'])->format('Ym');
            return $query->filter(fn($q) => $q->mes_ano_datetime->format('Ym') == $data);
        });
        $relatorio->mediaMensal = $mediaMensal->sum("valorTotal") / divisaoZero($mediaMensal->count());

        return view('relatorios.showGasto', [
            'parametros' => $dados,
            'array' => $dadosChart,
            'movimentos' => $movimentos,
            'relatorio' => $relatorio,
            'relatorioCategorias' => $relatorioCategorias
        ])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
