<?php
namespace Core;

class Controller
{
    /**
     * Load a view file
     */
    protected function view($view, $data = [])
    {
        extract($data); // Makes $data['foo'] accessible as $foo in the view
        require_once __DIR__ . '/../app/views/layouts/header.php';
        require_once __DIR__ . '/../app/views/' . $view . '.php';
        require_once __DIR__ . '/../app/views/layouts/footer.php';

    }

}
