<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('public/inicio_proceso');
    }

    public function inicio(): string
    {
        return $this->index();
    }

}
