<?php

namespace App\Exceptions;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Exception;

class mysqlErrorException extends Exception
{
    function report()
    {
        # code...
    }

    function render()
    {
        return view('erros.mysqlError')->render();
    }
}
