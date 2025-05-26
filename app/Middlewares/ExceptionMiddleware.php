<?php

namespace App\Middlewares;

use Throwable;

class ExceptionMiddleware
{
    public function handle(Throwable $exception)
    {
        // Pega o código da exceção, garantindo que será um número inteiro (padrão 500)
        $errorCode = (int) ($exception->getCode() ?: 500);

        // Define o código de resposta HTTP conforme o código da exceção
        http_response_code($errorCode);

        // $this->displayError($exception);
        // Exibe a página de erro diretamente
        $this->renderErrorPage($exception);
        exit;
    }

    private function displayError(Throwable $exception)
    {
        // Exibe detalhes do erro durante o desenvolvimento
        echo "<pre>";
        print_r([
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString(),
        ]);
        echo "<pre>";
        die();
    }


    private function renderErrorPage(Throwable $exception,)
    {
        $errorCode = $exception->getCode() ?? 500;
        $errorMessage = $exception->getMessage();
        $file = $exception->getFile();
        $line = $exception->getLine();
        $trace = $exception->getTraceAsString();
        $trace = str_replace('#', '<br>#', $trace);
        // Carregar e renderizar a view do erro
        include_once __DIR__ . '/../Views/404.php';  // Inclui o arquivo da view 404
        die();
    }
}
