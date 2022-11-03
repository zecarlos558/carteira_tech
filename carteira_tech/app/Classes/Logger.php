<?php

namespace App\Classes;

use Illuminate\Support\Facades\Log;

class Logger{

    public function log($level, $message)
    {

        // Tenta adicionar a mensagem a identificação do Usuário
        $usuario = auth()->user();
        if ($usuario) {
            $message = '['.'ID: '.$usuario->id.','.'Nome: '.$usuario->name.']'.' - '.$message;
        } else {
            $message = '[N/A]'.' - '.$message;
        }

        // Registra uma entrada no Log

        Log::channel('main')->$level($message);
    }

}



