<?php
namespace App\Core;

use App\Middlewares\ExceptionMiddleware;
use Exception;

class View
{
    /**
     * Renderiza uma view com header e footer.
     */
    public static function render(string $viewName, array $viewData = [])
    {
        try {
            $viewName = str_replace('.', '/', $viewName);
            $path = __DIR__ . "/../Views/$viewName.php";

            if (!file_exists($path)) {
                (new ExceptionMiddleware())->handle(throw new Exception("Arquivo View não encontrado: $path"), 404);
            }

            extract($viewData);

            // Cabeçalho
            $header = __DIR__ . "/../Views/partials/header.php";
            if (file_exists($header)) require $header;

            require $path;

            // Rodapé
            $footer = __DIR__ . "/../Views/partials/footer.php";
            if (file_exists($footer)) require $footer;
        } catch (Exception $e) {
            (new ExceptionMiddleware())->handle($e, 404);
        }
    }

    /**
     * Renderiza uma view modal (sem header/footer).
     */
    public static function renderModal(string $viewName, array $viewData = [])
    {
        $viewName = str_replace('.', '/', $viewName);
        $path = __DIR__ . "/../Views/$viewName.php";
        if (file_exists($path)) {
            extract($viewData);
            require $path;
        } else {
            (new ExceptionMiddleware())->handle(new Exception("Arquivo View nao encontrado: $viewName", 404));
        }
    }
}
