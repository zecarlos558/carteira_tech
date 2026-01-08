<?php

namespace App\Classes;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Component\Console\Color;

class Planilha extends Spreadsheet
{

    public $HORIZONTAL_CENTER = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;
    public $VERTICAL_CENTER = \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER;
    public $HORIZONTAL_JUSTIFY = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY;
    public $VERTICAL_JUSTIFY = \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_JUSTIFY;
    public $HORIZONTAL_LEFT = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT;
    public $HORIZONTAL_RIGHT = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT;
    public $VERTICAL_TOP = \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP;
    public $VERTICAL_BOTTOM = \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM;
    protected $with_header;
    protected $with_footer;
    public $style_titulo = [
        'font' => [
            'bold' => true,
            'italic' => false,
            'name' => 'Verdana',
            'size' => 12
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_PATTERN_DARKGRAY,
            'startColor' => [
                'argb' => "F5F5F5"
            ]
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                'color' => ['argb' => "000000"]
            ]
        ]
    ];
    public $style_cabecalho = [
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_PATTERN_DARKGRAY,
            'startColor' => [
                'argb' => "F5F5F5"
            ]
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOTTED,
                'color' => ['argb' => "000000"]
            ]
        ]
    ];

    public function __construct($with_header = true, $with_footer = true)
    {
        $this->with_header = $with_header;
        $this->with_footer = $with_footer;
        parent::__construct();
    }

    public function Header($sheet)
    {
        if ($this->with_footer) {
            $this->getProperties()->setCreator("Carteira Tech - SAMOTECH©");
            $this->getProperties()->setLastModifiedBy("Carteira Tech - SAMOTECH©");
            $this->getProperties()->setKeywords("SAMOTECH, CARTEIRA, TECH, DIGITAL");
            $this->getProperties()->setCategory("Desenvolvido e mantido por SAMOTECH Ltda.");
            $style = [
                'font' => [
                    'bold' => true,
                    'italic' => false,
                    'name' => 'Verdana'
                ]
            ];
            $sheet->getStyle('A1:A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY);

            $alfabeto = range('A', 'Z');
            for ($i = 0; $i < 8; $i++) {
                $sheet->setCellValue($alfabeto[$i] . '1', $i != 0 ? '' : ("CARTEIRA TECH"))->getStyle('A1')->applyFromArray($this->style_titulo);
            }
            $sheet->mergeCells('A1:J1');
            for ($i = 0; $i < 8; $i++) {
                $sheet->setCellValue($alfabeto[$i] . '2', $i != 0 ? '' : ("Relatório Financeiro"))->getStyle('A2')->applyFromArray($this->style_titulo);
            }
            $sheet->mergeCells('A2:J2');
            for ($i = 0; $i < 8; $i++) {
                $sheet->setCellValue($alfabeto[$i] . '3', $i != 0 ? '' : (""))->getStyle('A3')->applyFromArray($style);
            }
            $sheet->mergeCells('A3:J3');

            $sheet->getStyle('A1:J1')->getAlignment()->setHorizontal($this->HORIZONTAL_CENTER);
            $sheet->getStyle('A1:J1')->getAlignment()->setVertical($this->VERTICAL_CENTER);
            $sheet->getStyle('A2:J2')->getAlignment()->setHorizontal($this->HORIZONTAL_CENTER);
            $sheet->getStyle('A2:J2')->getAlignment()->setVertical($this->VERTICAL_CENTER);
        }
        return $sheet;
    }
}
