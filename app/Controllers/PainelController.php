<?php

namespace App\Controllers;

class PainelController extends \App\Core\Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard()
    {
        $this->render('home');
    }
}
