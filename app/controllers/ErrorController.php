<?php
namespace App\Controllers;

use Core\Controller;

class ErrorController extends Controller
{
    public function index()
    {
        http_response_code(404);
        $this->view('404');
    }
}
