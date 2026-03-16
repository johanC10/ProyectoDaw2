<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthSecretaria implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('secretaria_validada')) {
            return redirect()->to('/auth/secretaria')->with('error', 'Si us plau, inicia sessió per accedir.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $response->noCache();
    }
}