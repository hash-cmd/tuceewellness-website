<?php
namespace App\Controllers;

use Core\Controller;

class ServicesController extends Controller
{
    public function index()
    {
        $this->view('services');  
    }
}
