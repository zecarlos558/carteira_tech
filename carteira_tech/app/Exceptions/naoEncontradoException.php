<?php

namespace App\Exceptions;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use app\Exceptions\Handler as Handler;
use Throwable;
use Exception;

class naoEncontradoException extends Exception
{
    function report()
    {
        # code...
    }

    function render()
    {

        return view('erros.naoEncontrada')->render();
    }
}
