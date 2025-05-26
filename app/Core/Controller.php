<?php

namespace App\Core;

use Exception;

class Controller
{
    protected Request $request;

    public function __construct()
    {
        // Inicializa a propriedade $request
        $this->request = new Request();
    }

    /**
     * Acessa a classe Request.
     *
     * @return Request
     */
    protected function request(): Request
    {
        // Garante que $request está inicializada
        if (!isset($this->request)) {
            $this->request = new Request();
        }
        return $this->request;
    }

    protected function redirect($url)
    {
        header("Location: " . $this->getBaseUrl() . $url);
        exit;
    }

    private function getBaseUrl()
    {
        $_base = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? 'https://' : 'http://';
        $_base .= $_SERVER['SERVER_NAME'];
        if ($_SERVER['SERVER_PORT'] != '80') {
            $_base .= ':' . $_SERVER['SERVER_PORT'];
        }
        $_base .= BASE_DIR;
        $_base = rtrim($_base, '/');
        return $_base;
    }
    public function render($viewName, $viewData = [])
    {
        try {
            $viewData['flash_error'] = Flash::get('error');
            $viewData['flash_success'] = Flash::get('success');
            View::render($viewName,  $viewData);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 404);
        }
    }

    public function render_modal($viewName, $viewData = [])
    {
        $viewData['flash_error'] = Flash::get('error');
        $viewData['flash_success'] = Flash::get('success');
        View::renderModal($viewName,  $viewData);
    }

    protected function jsonResponse(array $data, int $status = 200)
    {
        // Retorna a resposta como JSON
        header('Content-Type: application/json');
        http_response_code($status); // Define o código de status HTTP
        echo json_encode($data); // Codifica os dados em JSON e os exibe
        exit; // Finaliza a execução após a resposta
    }
    protected function with($message)
    {
        Flash::with('success', $message);
    }

    protected function withError($message)
    {
        // Permite passar array ou string
        if (is_array($message)) {
            foreach ($message as $msg) {
                Flash::with('error', $msg);
            }
        } else {
            Flash::with('error', $message);
        }
    }
}
