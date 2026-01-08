<?php

namespace App\Classes;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class XLS extends Xlsx
{
    public function gerar($nome_arquivo)
    {
        $this->save($nome_arquivo);
        $content = file_get_contents($nome_arquivo);
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nome_arquivo . '_' . time() . '.xlsx"');
        header('Cache-Control: max-age=0');
        unlink($nome_arquivo);
        exit($content);
    }
}
