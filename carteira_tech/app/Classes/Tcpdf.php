<?php

namespace App\Classes;

use TCPDF as GlobalTCPDF;

class Tcpdf extends GlobalTCPDF
{
    protected $with_header;
    protected $add_header;
    protected $with_footer;
    protected $add_footer;

    public function __construct($orientation = PDF_PAGE_ORIENTATION, $unit = PDF_UNIT, $format = PDF_PAGE_FORMAT, $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false)
    {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
        $this->with_header = true;
        $this->with_footer = true;
        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor("SAMOTECH");
        $this->SetSubject("SAMOTECH - Carteira Tech");
        $this->SetKeywords("SAMOTECH, CARTEIRA, TECH, DIGITAL");
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    }

    public function setWithHeader(bool $with_header)
    {
        $this->with_header = $with_header;
    }

    public function setWithFooter(bool $with_footer)
    {
        $this->with_footer = $with_footer;
    }

    //Page header
    public function Header()
    {
        if ($this->with_header && $this->page == 1) {
            if (is_callable($this->add_header)) {
                call_user_func($this->add_header, $this);
            } else {
                $this->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
                $this->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
                $this->SetHeaderMargin(PDF_MARGIN_HEADER);

                $image_file = public_path("img/logomarca_favicon.ico");
                $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
                $this->SetFont('helvetica', 'B', 20);
                $this->Cell(0, 15, 'CARTEIRA TECH', 0, false, 'C', 0, '', 0, false, 'M', 'M');
                $this->Ln(13);
                $this->Cell($this->getPageWidth() - 17, 15, 'Relatório Financeiro', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            }
        }
    }

    // Page footer
    public function Footer()
    {
        if ($this->with_footer) {
            if (is_callable($this->add_footer)) {
                call_user_func($this->add_footer, $this);
            } else {
                $this->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                $this->SetFooterMargin(PDF_MARGIN_FOOTER);
                // Position at 15 mm from bottom
                $this->SetY(-15);
                $this->SetFont('helvetica', 'I', 9);
                if ($this->CurOrientation == 'L') {
                    $this->Cell(80, 5, 'Carteira Tech ', 'T', 0, 'L');
                    $this->Cell(170, 5, 'Desenvolvido e mantido por SAMOTECH.', 'T', 0, 'C');
                } else {
                    $this->Cell(90, 5, 'Carteira Tech ', 'T', 0, 'L');
                    $this->Cell(70, 5, 'Desenvolvido e mantido por SAMOTECH.', 'T', 0, 'C');
                }
                $this->Cell(0, 5, 'Página ' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages(), 'T', 0, 'L');
                $this->Ln(10);
            }
        }
    }

    public function SetAddHeader($func)
    {
        $this->add_header = $func;
    }

    public function SetAddFooter($func)
    {
        $this->add_footer = $func;
    }
}
